<?php

require_once 'helper-funcs/config.php';

$productPageProduct;

function validateInput($input){

    global $productPageProduct;

    if (filter_var($input, FILTER_VALIDATE_INT))
        $productPageProduct = selectProduct($input);

    else
        echo 'Invalid input!';
}

function selectProduct($id){

    global $db;

    $query = $db->prepare("SELECT Name,Description,filename,Price,Status FROM PRODUCTS WHERE id = ?");
    $query->execute([$id]);
    $product = $query->fetch(PDO::FETCH_OBJ);

    return $product;
}

