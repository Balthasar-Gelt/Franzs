<?php 

include 'partials/header.php';

require 'variables/dbConfig.php';
require 'page-funcs/classes/DB.php';
require 'page-funcs/helper-funcs/addImage.php';

$db = new DB($dbConfig);
$products = $db->fetchRows('SELECT Price,id,filename,Name,Status,Price FROM PRODUCTS');
?>

    <div class="container shop_container row_reverse align_items_start main_padding">

        <div id="aside_overlay"></div>
        <img id="aside_button" src="assets/other/<.svg" alt="Hey, Vsauce, image here">
        <aside class="side_content">
            <ul>
                <li class="side_content_cell">
                    <h1>CATEGORIES</h1>

                    <ul>
                        <li><a href="">Shoes</a> <span>(509)</span></li>
                        <li><a href="">Belts</a> <span>(509)</span></li>
                        <li><a href="">Beards</a> <span>(509)</span></li>
                    </ul>
                </li>

                <li class="side_content_cell">
                    <h1>FILTER BY PRICE</h1>
                    
                    <div>
                        <span id="slider-snap-value-lower">0</span>
                        <span>-</span>
                        <span id="slider-snap-value-upper">1000</span>
                    </div>

                    <div class="slider"></div>

                    <a id="filter_button" href="#">FILTER</a>

                    </li>
                </ul>
            </aside>

        <main class="shop_items">

            <ul class="item_list">
                <?php
                    foreach($products as $product){

                        echo "<li class='item' data-price=".$product->Price.">
                                <a href="."product-page.php?id=".$product->id.">
                                    <img src=".addImage($product->filename)." alt='Hey, Vsauce, image here'>
                                
                                    <div class='item_text'>
                                        <h1>".$product->Name."</h1>
                                        <span>".$product->Status."</span>
                                        <h1>".$product->Price." $</h1>
                                    </div>
                                </a>
                            </li>";
                    }
                ?>
            </ul>
        </main>

    </div>

<?php include 'partials/footer.php'; ?>