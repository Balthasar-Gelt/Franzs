<?php

require 'redirect.php';
require 'answer.php';
require '../../variables/dbConfig.php';
require '../classes/CartManager.php';
require '../classes/Cart.php';
require '../classes/DB.php';

// Performs action based action type
// First checks if item id is INT, and if it exists in db
// Then checks if selected action is available
// If both values pass validation then the selected action is performed with sent item id

$db = new DB($dbConfig);
$cart = new Cart($db);
$cartManager = new CartManager($cart->getCartItems(), new DB($dbConfig));

$availableActions = ['addToCart', 'deleteFromCart', 'emptyCart'];
$checks = [];
$response;

$checks['id'] = checkItemId($_GET['id']);
$checks['type'] = in_array($_GET['type'], $availableActions);

checkArray($checks);

$func = $_GET['type'];
$response = $cartManager->$func($_GET['id']);

redirect(answer($response));

// FUNCTIONS

function checkItemId($itemId){

    global $db;

    if(filter_var($itemId, FILTER_VALIDATE_INT)){

        if($db->fetchRow('SELECT id FROM PRODUCTS WHERE id =?', [$itemId]) !== false)
            return true;
    }

    return false;
}

function checkArray($array){

    foreach ($array as $check) {
    
        if(!$check)
            redirect();
    }
}