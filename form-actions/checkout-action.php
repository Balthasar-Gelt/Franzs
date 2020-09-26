<?php

require '../variables/dbConfig.php';
require '../page-funcs/classes/DB.php';
require '../page-funcs/classes/CartManager.php';
require '../page-funcs/classes/Cart.php';
require '../page-funcs/helper-funcs/answer.php';
require '../page-funcs/helper-funcs/sentinel-use.php';
require '../page-funcs/classes/CheckoutValidator.php';

use Cartalyst\Sentinel\Native\Facades\Sentinel;

$redirectString = 'http://localhost:8888/Dealers/checkout-final-page.php?message=';

$requiredInputs = ['form_email', 'form_first_name', 'form_last_name', 'form_street', 'form_city', 
                    'form_country', 'form_post', 'form_phone', 'form_card_number', 'form_card_name', 
                    'form_card_expiration', 'form_card_security_code' ];

$db = new DB($dbConfig);
$cart = new Cart($db);
$cartManager = new CartManager($cart->getCartItems(), $db);

$postData = array();

if(checkRequiredInputs($requiredInputs)){

    foreach ($_POST as $key => $data) {

        $postData[removeFirstForm($key)] = $_POST[$key];
    }
}

$postData = (object)$postData;

if(Sentinel::getUser())
    $postData->userId = Sentinel::getUser()->id;
else
    $postData->userId = null;

$postData->orderTotal = getOrderTotal($postData->delivery);

$inputsForValidation = [
    'email' => (string)$postData->email,
    'phone' => (string)$postData->phone,
    'cardNumber' => (string)$postData->card_number,
    'cardExpirationDate' => (string)$postData->card_expiration,
    'cardSecurityCode' => (string)$postData->card_security_code
];

$validator = new CheckoutValidator($inputsForValidation);

$checks = [
    'input' => $validator->validate(),
    'cartContent' => checkForItemStatus()
];

foreach ($checks as $key => $check) {
     
    if($check !== true)
        checkoutRedirect($check, $key);
}

insertOrder($postData);
$cartManager->emptyCart();

checkoutRedirect( [1, $redirectString . getLastOrderNumber()], getLastOrderNumber() );







/**
 * FUNCTIONS
 */

function checkoutRedirect($fetchMessage, $nonFetchMessage){

    global $redirectString;

    if(isset($_SERVER['HTTP_FETCH']))
        die(answer($fetchMessage));

    else{

        header('Location: ' . $redirectString . $nonFetchMessage);
        die();
    }
}

function checkRequiredInputs($requiredInputs){

    global $postData;

    foreach ($requiredInputs as $input) {

        if($_POST[$input] != ''){
            $postData[removeFirstForm($input)] = $_POST[$input];
            unset($_POST[$input]);
        }
        else
            checkoutRedirect([2, 'Invalid ' . makeMessageString($input), removeFirstForm($input)], 'input');
    }

    return true;
}

function checkForItemStatus(){

    global $cartManager;

    foreach ($cartManager->checkItemStatus() as $value) {
        
        if($value != 'In Stock')
            return [2, 'One or more items in your cart have already been reserved'];
    }

    return true;
}

function insertOrder($orderData){

    global $db, $cart;

    $valuesToInsert = [$orderData->userId,$orderData->orderTotal,$orderData->email,
    $orderData->first_name,$orderData->last_name,$orderData->street,
    $orderData->city,$orderData->province,$orderData->country,
    $orderData->post,$orderData->phone,$orderData->delivery,
    $orderData->card_number,$orderData->card_name,
    $orderData->card_expiration,$orderData->card_security_code, date('Y-m-d')];

    $dbString = "INSERT INTO ORDERS 
    (USERID, ORDERTOTAL, 
    EMAIL, NAME, SURENAME, 
    STREET, CITY, PROVINCE, 
    COUNTRY, POSTCODE, PHONE, 
    DELIVERY, CARDNUMBER, NAMEONCARD, 
    CARDEXPIRATION, CARDSECURITYCODE, DELIVERYDATE)
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    
    if($db->updateRow($dbString , $valuesToInsert)){

        insertOrderItems($cart->getCartItems(), getLastOrderNumber());
        changeitemStatus($cart->getCartItems(),'Reserved');
            
        return true;
    }

    else{
        return [3, 'Something went wrong, try making your order again later'];
    }
}

function getLastOrderNumber(){

    global $db;

    $orderId = $db->fetchRow("SELECT id FROM ORDERS ORDER BY id DESC LIMIT 1");

    if($orderId != false)
        $orderId = (int)$orderId->id;
    else
        $orderId = 0;
    
    return $orderId;
}

function getOrderTotal($delivery){

    global $cart;

    $defaultShipping = 10;
    $expressShipping = 20;

    return ($delivery == 'standard') ? 
    $orderTotal = $cart->getCartTotal($defaultShipping) : 
    $orderTotal = $cart->getCartTotal($expressShipping);
}

function insertOrderItems($cartItems, $orderNumber){

    global $db;

    foreach ($cartItems as $item) {
        
        $db->updateRow("INSERT INTO ORDEREDPRODUCTS (PRODUCTID, ORDERID) VALUES (?,?)", [$item, $orderNumber]);
    }
}

function changeitemStatus($cartItems, $status){

    global $db;

    foreach ($cartItems as $item) {

        $db->updateRow("UPDATE PRODUCTS SET Status = ? WHERE id = ?", [$status, $item]);
    }
}

function removeFirstForm($string){

    return substr($string, strpos($string, "_")+1);
}

function makeMessageString($string){

    $string = removeFirstForm($string);

    $string = str_replace("_", " ", $string);
    
    return $string;
}