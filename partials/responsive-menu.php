<?php

require_once 'nav-menu.php';
echo '<div class="menu_overlay">';
echo '<div class="overlay_img_wrapper">';
echo '<img src="'.'http://'. $_SERVER['SERVER_NAME'] .':'. $_SERVER['SERVER_PORT'] .'/Dealers/assets/other/clear.svg' .'" alt="Hey, Vsauce, image here">';
echo '</div>';
printNavMenu();
echo '</div>';