<?php

require '../classes/DB.php';
require 'addImage.php';
require '../../variables/dbConfig.php';

$searchText;

if(isset($_GET['searchText']))
    $searchText = $_GET['searchText'];

else
    die();

$db = new DB($dbConfig);
$products = $db->fetchRows("SELECT id,Name,filename,Price,Status FROM PRODUCTS WHERE Name LIKE ?", [$searchText."%"]);

foreach ($products as $product) {
    
    $productElement = "<li>
                    <a class='display_flex searched_item_link' href='product-page.php?id=".$product->id."'>
                        <img src=".addImage($product->filename)." alt='Hey, Vsauce, image here'>
                        <h1>".$product->Name."</h1>
                        <span class='searched_item_status'>".$product->Status."</span>
                        <span class='searched_item_price'>".$product->Price."€</span>
                    </a>
                   </li>";

    echo $productElement;
    
}

die();

?>