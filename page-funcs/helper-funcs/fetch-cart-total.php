<?php

require '../../variables/dbConfig.php';
require '../classes/DB.php';
require '../classes/Cart.php';

$db = new DB($dbConfig);
$cart = new Cart($db);

die($cart->getCartTotal());