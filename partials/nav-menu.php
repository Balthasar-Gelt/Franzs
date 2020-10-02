<?php

require_once "page-funcs/helper-funcs/sentinel-use.php";

use Cartalyst\Sentinel\Native\Facades\Sentinel;

function printNavMenu(){

    echo '<ul>';
    echo    '<li><a href="shop.php">Shop</a></li>';
    echo    '<li><a class="about_us_link" href="#">About Us</a></li>';
    echo    '<li><a class="contact_link" href="#">Contact</a></li>';
    echo '</ul>';
    
    echo '<ul>';
    echo    '<li><a class="search_link" href="#">Search</a></li>';
    echo    '<li><a href="cart.php">Cart</a></li>';
    
            if(Sentinel::check()){
                echo '<li><a class="log_out_link" href="page-funcs/log-out-action.php">Log Out</a></li>';
                echo '<li><a class="dashboard_link" href="dashboard.php">Dashboard</a></li>';
                echo '<li style="display:none;"><a class="log_in_link" href="#">Log In</a></li>';
            }
            else{
                echo '<li style="display:none;"><a class="log_out_link" href="page-funcs/log-out-action.php">Log Out</a></li>';
                echo '<li style="display:none;"><a class="dashboard_link" href="dashboard.php">Dashboard</a></li>';
                echo '<li><a class="log_in_link" href="#">Log In</a></li>';
            }
    echo '</ul>';
}