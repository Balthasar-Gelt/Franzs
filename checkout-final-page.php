<?php

if (session_status() == PHP_SESSION_NONE)
session_start();

if(!isset($_SESSION['checkOutStatus'])){
    header('Location:http://localhost:8888/Dealers/' . 'cart.php');
    die();
}


else{
    if($_SESSION['checkOutStatus'] != "pending"){
        header('Location:http://localhost:8888/Dealers/' . 'cart.php');
        die();
    }
}
    
include 'partials/header.php';

?>

<div class="checkout-final">

    <?php

        switch ($_GET['message']) {

            case 'input':
                echo '<div>';
                echo '<img src="assets/other/icons8-cancel.svg" alt="hey, Vsauce, Image here">';
                echo '<h1>Something went wrong!</h1>';
                echo '<h2>Some of the information you have provided are wrong. Try placing your order again.</h2>';
                echo '</div>';
                break;

            case 'cartContent':
                echo '<div>';
                echo    '<img src="assets/other/icons8-cancel.svg" alt="hey, Vsauce, Image here">';
                echo    '<h1>Something went wrong!</h1>';
                echo    '<h2>We are sorry, but one or more items you tried to order have already been reserved.</h2>';
                echo    '</div>';
                break;

            case 'dbInsert':
                echo '<div>';
                echo '<img src="assets/other/icons8-cancel.svg" alt="hey, Vsauce, Image here">';
                echo '<h1>Something went wrong!</h1>';
                echo '<h2>Please try placing your order again.</h2>';
                echo '</div>';
                break;

            default:
                echo '<div class="checkout_text_block">';
                echo '<img src="assets/other/icons8-ok.svg" alt="hey, Vsauce, Image here">';
                echo '<h1>Thank you for shopping with us!</h1>';
                echo '<h2>We have successfully registered your order.</h2>';
                echo "<h2>Your order number is " . $_GET['message'] . "</h2>";
                echo '</div>';
                break;
        }
        $_SESSION['checkOutStatus'] = "done";
    ?>
</div>

<?php include 'partials/footer.php'; ?>