
<?php
require 'page-funcs/get-products.php';
require 'page-funcs/helper-funcs/addImage.php';
require 'page-funcs/helper-funcs/redirect.php';
require 'page-funcs/classes/DB.php';
require 'variables/dbConfig.php';

$product = getProducts(new DB($dbConfig), [$_GET['id']], ['filename', 'Name', 'Description', 'Price', 'Status'])[0];

if(!filter_var($_GET['id'], FILTER_VALIDATE_INT) || !$product)
    redirect();

include 'partials/header.php';
?>

    <section class="product_section container display_flex">
            <aside class="image_wrapper">
                <img src=<?php echo addImage($product->filename); ?> alt="product Img">
            </aside>

            <aside class="product_page_text_wrapper">
                <h1 class="heading_medium"><?php echo $product->Name; ?></h1>
                
                <P class="text"><?php echo $product->Description; ?></P>
                
                <span class="price"><?php echo $product->Price; ?> $</span>

                <div class="availability">
                    Availability: <?php echo '<span class="' .str_replace(' ', '', $product->Status) . '">';
                        echo $product->Status;
                        echo '</span>';?>
                </div>
                <?php
                    if($product->Status == "In Stock")
                        echo "<a class='product_button add_product' href='page-funcs/helper-funcs/cart-action.php?id=".$_GET['id']."&type=addToCart'>ADD TO CART</a>";
                ?>
                
            </aside>
    </section>

<?php include_once 'partials/footer.php'; ?>