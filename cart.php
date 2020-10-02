<?php
include 'partials/header.php';

require 'variables/dbConfig.php';
require 'page-funcs/classes/DB.php';
require 'page-funcs/classes/Cart.php';
require 'page-funcs/get-products.php';
require 'page-funcs/helper-funcs/addImage.php';

$canCheckOut = false;

$db = new DB($dbConfig);
$cart = new Cart($db);

$cartItems = getProducts($db, $cart->getCartItems(), ['Status', 'filename', 'Name', 'Price', 'id']);
?>

<div id="cart" class="container main_padding">
    
    <div class="cart_header">
        <div class="cart_wide_width">Product</div>
        <div class="cart_narrow_width">Status</div>
        <div class="cart_narrow_width">Price</div>
        <div class="cart_narrow_width">Remove</div>
    </div>

    <div id="cart_content">
    <?php

    if(!empty($cart->getCartItems())){

        $_SESSION['checkOutStatus'] = 'pending';
        $canCheckOut = true;

        foreach ($cartItems as $item) {

            if($item->Status != 'In Stock')
                $canCheckOut = false;

            echo "<div class='product'>
            <div class='cart_wide_width'>
            <img class='product_img' src=".addImage($item->filename)." alt='Hey, Vsauce, image here.'>
            <div class='product_text_box'>
                <span>".$item->Name."</span>
                </div>
            </div>

            <div class='cart_narrow_width'>".$item->Status."</div>
            <div class='cart_narrow_width'>".$item->Price."</div>

            <div class='remove_product_wrapper cart_narrow_width'>
                <a class='remove_product_link' href='page-funcs/helper-funcs/cart-action.php?id=".$item->id."&type=deleteFromCart'>
                    <img class='remove_product' src='assets/other/remove-24px.svg' alt='Delete'>
                </a>
            </div>
            </div>"; 
        }
    }

    else{
        echo '<div class="empty_cart">Your cart is empty</div>';
    }

    ?>
    </div>

    <div class="cart_bottom_wrapper">
        <div class="cart_total">
            <h1>CART TOTAL:</h1>
            <span><?php echo $cart->getCartTotal();?> €</span>
        </div>
        
        <a id="checkout_link"
             <?php
                if($canCheckOut){
                    echo 'href="checkout.php"';
                }
                
                else{
                    echo 'class="disabled_button"';
                    echo 'disabled ';
                    echo 'href="#"';
                }
            ?>
        >PROCEED TO CHECKOUT</a>
    </div>
</div>

<?php include 'partials/footer.php'; ?>