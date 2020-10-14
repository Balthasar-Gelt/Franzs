<?php
include 'partials/header.php';

require 'page-funcs/classes/IndexPage.php';
require 'page-funcs/classes/DB.php';
require 'page-funcs/helper-funcs/addImage.php';
require 'variables/dbConfig.php';
require 'variables/currency-symbol.php';

$indexPage = new IndexPage(new DB($dbConfig));

?>

    <header class="container">

        <section class="header_main">
            <div class="header_title center_text">
                <h1><?php echo $indexPage->getProperty('title'); ?></h1>
                <h2><?php echo $indexPage->getProperty('subTitle'); ?></h2>
                <h3>Browse Our Collection</h3>
                <a href="shop.php">SHOP NOW</a>
            </div>
        
            <img src= <?php echo addImage($indexPage->getProperty('titlePictureName')); ?> alt="Hey, Vsauce, image here">
        </section>

    </header>

        <ul class="item_list">

            <?php

                $products = $indexPage->getProperty('products');

                foreach ($products as $key => $product) {
                    
                    echo
                    '<li class="item">
                        <a href=product-page.php?id='. $product->id .'>
                            <img src='. addImage($product->filename) .' alt="nist">

                            <div class="item_text">
                                <h1>'. $product->Name .'</h1>
                                <span>'. $product->Status .'</span>
                                <h1>'. $product->Price .' '. $currencySymbol .'</h1>
                            </div>
                        </a>
                    </li>';
                }
            ?>
        </ul>

        <section class="one_product_row container">

            <aside>
                <h1> <?php echo $indexPage->getProperty('bottomRowTitle'); ?> </h1>
                <a href="shop.php">SHOP NOW</a>
            </aside>

            <img src= <?php echo addImage($indexPage->getProperty('bottomRowImageName')); ?> alt="clock">

        </section>

        
<?php
include 'partials/footer.php';
?>