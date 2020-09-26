<?php

require 'redirect.php';
require 'answer.php';
require '../../variables/dbConfig.php';
require '../classes/CartManager.php';
require '../classes/Cart.php';
require '../classes/DB.php';

$availableActions = ['addToCart', 'deleteFromCart', 'emptyCart'];
$validations = [];
$response;

$validations['id'] = filter_var($_GET['id'], FILTER_VALIDATE_INT);
$validations['type'] = in_array($_GET['type'], $availableActions);

foreach ($validations as $valid) {
    
    if(!$valid)
        redirect();
}

$cart = new Cart(new DB($dbConfig));
$cartManager = new CartManager($cart->getCartItems(), new DB($dbConfig));

$func = $_GET['type'];
$response = $cartManager->$func($_GET['id']);

redirect(answer($response));