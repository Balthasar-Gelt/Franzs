<?php

function addImage($productImage){

    $pathToTest = realpath(__DIR__ . '/../../') . '/assets/products/' . $productImage;
    $pathToReturn = 'http://'. $_SERVER['SERVER_NAME'] .':'. $_SERVER['SERVER_PORT'] .'/Franzs/' . '/assets/products/' . $productImage;

    if (file_exists("${pathToTest}.png"))
        return "${pathToReturn}.png";

    else
        return "${pathToReturn}.img";
}