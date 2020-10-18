<?php

function getProducts(DB $db, array $cart, array $attributes){

    foreach ($cart as $key => $itemId) {

        $cart[$key] = $db->fetchRow('SELECT '. implode(',', $attributes) .' FROM PRODUCTS WHERE id =?', [$itemId]);
    }

    return $cart;
}