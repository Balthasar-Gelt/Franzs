<?php

require_once 'nav-menu.php';
require_once './variables/baseUrl.php';

echo '<div class="menu_overlay">';
echo '<img src="'. BASE_URL .'/assets/other/clear.svg' .'" alt="Hey, Vsauce, image here">';
printNavMenu();
echo '</div>';