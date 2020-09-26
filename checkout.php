<?php

require 'page-funcs/helper-funcs/addImage.php';
require 'page-funcs/helper-funcs/printValue.php';
require 'variables/dbConfig.php';
require 'page-funcs/classes/DB.php';
require 'page-funcs/classes/Cart.php';
require 'page-funcs/get-products.php';

$db = new DB($dbConfig);
$cart = new Cart($db);

$cartItems = getProducts($db, $cart->getCartItems(), ['filename', 'Name', 'Price']);

$defaultShipping = 10;
$expressShipping = 20;

if (session_status() == PHP_SESSION_NONE)
session_start();

if(!isset($_SESSION['checkOutStatus'])){
    header('Location:http://localhost:8888/Dealers/' . 'cart.php');
    die();
}

else{
    if($_SESSION['checkOutStatus'] != "pending" || empty($cart->getCartItems())){
        header('Location:http://localhost:8888/Dealers/' . 'cart.php');
        die();
    }
}

include 'partials/header.php';

use Cartalyst\Sentinel\Native\Facades\Sentinel;

$user = Sentinel::getUser();
?>
<div class="main_padding">

<h1 class="container form_header">Checkout</h1>

<div class="container preview_wrapper">
    <div class="checkout_item_preview">Preview Cart Items</div>
</div>

<div class="checkout_container row_reverse container display_flex align_items_start ">

    <div class="product_table_checkout">
        <ul>
            <?php

                if($cartItems != null){

                    foreach ($cartItems as $item) {
  
                    echo "<li class='display_flex'>
                    <img src=".addImage($item->filename)." alt='hey, Vsauce, image here'>
                    <span class='checkout_item_name'>".$item->Name."</span>
                    <span class='checkout_item_price'>".$item->Price." $</span>
                    </li>";
                    }
                }
            ?>
        </ul>

        <div class="checkout_price_wrapper display_flex">
            <span>Subtotal</span>
            <span><?php echo $cart->getCartTotal() ?> $</span>
        </div>

        <div class="checkout_price_wrapper shipping display_flex">
            <span>Shipping</span>
            <span id="product_table_shipping"><?php echo $defaultShipping; ?> $</span>
        </div>

        <div class="checkout_total display_flex">
            <h3>Total</h3>
            <span><?php echo $cart->getCartTotal($defaultShipping) ?> $</span>
        </div>
    </div>

    <form id="checkout_form" autocomplete="off" class="checkout_form" action="form-actions/checkout-action.php" method="post">

        <div class="form_input form_row">
            <label for="form_email">Email address</label>
            <input value="<?php printValue($user,'email'); ?>" required class="checkout_input" placeholder="Email address" type="email" id="form_email" name="form_email">
            <span class="alert email_alert">Invalid input</span>
        </div>

        <div class="form_row display_flex">
            <div class="form_input small_input">
                <label for="form_first_name">First name</label>
                <input value="<?php printValue($user, 'first_name'); ?>" required class="checkout_input" placeholder="First name" type="text" id="form_first_name" name="form_first_name">
                <span class="alert first_name_alert">Invalid input</span>
            </div>

            <div class="form_input small_input">
                <label for="form_last_name">Last name</label>
                <input value="<?php printValue($user, 'last_name'); ?>" required class="checkout_input" placeholder="Last name" type="text" id="form_last_name" name="form_last_name">
                <span class="alert last_name_alert">Invalid input</span>
            </div>
        </div>

        <div class="form_input form_row">
            <label for="form_street">Street address</label>
            <input value="<?php printValue($user, 'street_address'); ?>" required class="checkout_input" placeholder="Street address" type="text" id="form_street" name="form_street">
            <span class="alert street_alert">Invalid input</span>
        </div>

        <div class="form_input form_row">
            <label for="form_city">City</label>
            <input value="<?php printValue($user, 'city'); ?>" required class="checkout_input" placeholder="City" type="text" id="form_city" name="form_city">
            <span class="alert city_alert">Invalid input</span>
        </div>

        <div class="form_input form_row">
            <label for="form_city">Province/State</label>
            <input value="<?php printValue($user, 'province'); ?>" class="checkout_input" placeholder="Province/State" type="text" id="form_province" name="form_province">
        </div>

        <div class="form_row display_flex">
            <div class="form_input small_input">
                <label for="form_country">Country</label>
                <input value="<?php printValue($user, 'country'); ?>" required class="checkout_input" placeholder="Country" type="text" id="form_country" name="form_country">
                <span class="alert country_alert">Invalid input</span>
            </div>

            <div class="form_input small_input">
                <label for="form_post">Postal code</label>
                <input value="<?php printValue($user, 'postal_code'); ?>" required class="checkout_input" placeholder="Postal code" type="text" id="form_post" name="form_post">
                <span class="alert post_alert">Invalid input</span>
            </div>
        </div>

        <div class="form_input form_row">
            <label for="form_phone">Phone number</label>
            <input value="<?php printValue($user, 'phone_number'); ?>" required class="checkout_input" placeholder="Phone number" type="tel" id="form_phone" name="form_phone">
            <span class="alert phone_alert">Invalid input</span>
        </div>

        <h2 class="form_header">Shipping options</h2>

        <div class="display_flex form_row">
            <div class="form_input grey_border radio_button_wrapper small_input display_flex">
                <input required type="radio" id="form_delivery_standard" name="form_delivery" value="standard" checked>
                <label value="<?php echo $defaultShipping; ?>" class="display_flex" for="form_delivery_standard">
                    <span>Standard delivery (5-7 days)</span>
                    <span><?php echo $defaultShipping; ?>€</span>
                </label>
            </div>

            <div class="form_input grey_border radio_button_wrapper small_input display_flex">
                <input required type="radio" id="form_delivery_express" name="form_delivery" value="express">
                <label value="<?php echo $expressShipping; ?>" class="display_flex" for="form_delivery_express">
                    <span>Express delivery (1-3 days)</span>
                    <span><?php echo $expressShipping; ?>€</span>
                </label>
            </div>
        </div>

        <h2 class="form_header">Payment</h2>

        <div class="form_input grey_border">
            <div class="credit_card_wrapper display_flex">
                <span>Credit card</span>
                <ul class="credit_card_list display_flex">
                    <li>Visa</li>
                    <li>Master card</li>
                    <li>Amex</li>
                </ul>
            </div>
        </div>

        <div class="card_fields_wrapper">
            <div class="form_input form_row">
                <label for="form_card_number">Card number</label>
                <input required class="checkout_input" placeholder="Card number" type="text" id="form_card_number" name="form_card_number">
                <span class="alert card_number_alert">Invalid input</span>
            </div>

            <div class="form_input form_row">
                <label for="form_card_name">Name on card</label>
                <input required class="checkout_input" placeholder="Name on card" type="text" id="form_card_name" name="form_card_name">
                <span class="alert card_name_alert">Invalid input</span>
            </div>

            <div class="form_row display_flex">
                <div class="form_input small_input">
                    <label for="form_card_expiration">Expiration date</label>
                    <input required class="checkout_input" placeholder="Expiration date (MM/YYYY)" type="text" id="form_card_expiration" name="form_card_expiration">
                    <span class="alert card_expiration_alert">Invalid input</span>
                </div>

                <div class="form_input small_input">
                    <label for="form_card_security_code">Security code</label>
                    <input required class="checkout_input" placeholder="Security code" type="text" id="form_card_security_code" name="form_card_security_code">
                    <span class="alert card_security_code_alert">Invalid input</span>
                </div>
            </div>
        </div>

        <div class="display_flex">
            <div></div>
            <button id="checkout_form_button" class="product_button" type="submit">Submit and pay</button>
        </div>
    </form>
</div>
</div>
<?php include 'partials/footer.php'; ?>
