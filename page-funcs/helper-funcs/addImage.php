<?php

require_once 'variables/baseUrl.php';
require_once 'variables/serverPath.php';

function addImage($productImage){

    $pathToTest = SERVER_PATH . '/assets/products/' . $productImage;
    $pathToReturn = BASE_URL . '/assets/products/' .$productImage;

    if (file_exists("${pathToTest}.png"))
        return "${pathToReturn}.png";

    else
        return "${pathToReturn}.img";
}