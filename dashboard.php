<?php

require_once 'page-funcs/helper-funcs/sentinel-use.php';
require_once 'page-funcs/helper-funcs/redirect.php';
require_once 'page-funcs/dashboard-func.php';
require_once 'page-funcs/helper-funcs/addImage.php';

use Cartalyst\Sentinel\Native\Facades\Sentinel;

$standard = 10;
$express = 20;
$user = null;

if(!Sentinel::check()){
    redirect();
    die();
}
else
    $user = Sentinel::getUser();

include 'partials/header.php';
?>

<div class="main_padding container">

    <h1 class="page_title">Dashboard</h1>

    <section class="dashboard_section">

        <h1>Pending Orders</h1>

        <div class="pending dashboard_section_content_wrapper">

            <div class="pending_content dashboard_section_content">
<?php

    $pendingOrders = pendingOrders(Sentinel::getUser()->id);

    foreach ($pendingOrders->orders as $iterator => $order) {

        if(($iterator % 2) == 0){
            echo '<div class="pending_order_list_row display_flex">';
        }

        echo '<ul class="pending_order_list">
                <li class="display_flex order_number">
                    <h2>Order Number</h2>
                    <span>' .$order->id. '</span>
                </li>';

        foreach ($pendingOrders->products[$iterator] as $product) {
            
            echo '<li class="display_flex dashboard_product">
                    <img src="' .addImage($product->fileName). '" alt="">
                    <h3>'. $product->name .'</h3>
                    <span>'. $product->price .' $</span>
                </li>';
        }

        echo    '<li class="display_flex">
                    <h3>Delivery</h3>
                    <span>'. ($order->delivery == 'standard' ? 10 : 20) .' $</span>
                    </li>

                <li class="display_flex">
                    <h3>Order total</h3>
                    <span>'. $order->orderTotal .' $</span>
                </li>
            </ul>';

        if(($iterator % 2) == 1)
            echo '</div>';
    }

    if(isset($iterator)){
        if((isset($iterator) && $iterator % 2) == 0)
            echo '</div>';
    }

?>

            </div>

        </div>

        <div class="dashboard_arrow_container">
            <img src="assets/other/arrow.png" alt="">
            <div id="pending" class="arrow_container_overlay"></div>
        </div>

    </section>
    
    <section class="dashboard_section">

        <h1>Order History</h1>

        <div class="history dashboard_section_content_wrapper">

            <div class="history_content dashboard_section_content">

                <ul class="order_history_list">

                <?php
                
                $orderHistory = orderHistory(Sentinel::getUser()->id);

                foreach ($orderHistory->orders as $order) {

                    echo '
                    <li>

                        <div class="display_flex">
                            <h2 class="display_flex"><strong>Order Number</strong> '. $order->id .'</h2>
                            <span class="display_flex"><strong>Order total</strong> '. $order->orderTotal .' $</span>
                            <span class="display_flex"><strong>Order delivered</strong>'. formatDate($order->deliveryDate) .'</span>
                        </div>

                    </li>';
                }

                ?>


                </ul>
            
            </div>
        
        </div>

        <div class="dashboard_arrow_container">
            <img src="assets/other/arrow.png" alt="">
            <div id="history" class="arrow_container_overlay"></div>
        </div>

    </section>

    <section class="dashboard_section">

        <h1>User Information</h1>
    
        <form id="change_user_data_form" autocomplete="off" class="user_info_form" action="form-actions/change-user-info-action.php" method="post">

            <div class="form_input form_row">
                <label for="form_email">Email address</label>
                <input value="<?php echo $user->email; ?>" required class="checkout_input" placeholder="Email address" type="email" id="form_email" name="form_email">
                <span class="alert email_alert">Invalid input</span>
            </div>

            <div class="form_row display_flex">
                <div class="form_input small_input">
                    <label for="form_first_name">First name</label>
                    <input value="<?php echo $user->first_name; ?>" required class="checkout_input" placeholder="First name" type="text" id="form_first_name" name="form_first_name">
                </div>

                <div class="form_input small_input">
                    <label for="form_last_name">Last name</label>
                    <input value="<?php echo $user->last_name; ?>" required class="checkout_input" placeholder="Last name" type="text" id="form_last_name" name="form_last_name">
                </div>
            </div>

            <div class="form_input form_row">
                <label for="form_street">Street address</label>
                <input value="<?php echo $user->street_address; ?>" required class="checkout_input" placeholder="Street address" type="text" id="form_street" name="form_street">
            </div>

            <div class="form_input form_row">
                <label for="form_city">City</label>
                <input value="<?php echo $user->city; ?>" required class="checkout_input" placeholder="City" type="text" id="form_city" name="form_city">
            </div>

            <div class="form_input form_row">
                <label for="form_city">Province/State</label>
                <input value="<?php echo $user->province; ?>" class="checkout_input" placeholder="Province/State" type="text" id="form_province" name="form_province">
            </div>

            <div class="form_row display_flex">
                <div class="form_input small_input">
                    <label for="form_country">Country</label>
                    <input value="<?php echo $user->country; ?>" required class="checkout_input" placeholder="Country" type="text" id="form_country" name="form_country">
                </div>

                <div class="form_input small_input">
                    <label for="form_post">Postal code</label>
                    <input value="<?php echo $user->postal_code; ?>" required class="checkout_input" placeholder="Postal code" type="text" id="form_post" name="form_post">
                </div>
            </div>

            <div class="form_input form_row">
                <label for="form_phone">Phone number</label>
                <input value="<?php echo $user->phone_number; ?>" required class="checkout_input" placeholder="Phone number" type="tel" id="form_phone" name="form_phone">
                <span class="alert phone_alert">Invalid input</span>
            </div>

            <button id="change_user_data_form_button" class="product_button" type="submit">Save changes</button>
        </form>

    </section>

</div>

<?php include 'partials/footer.php'; ?>