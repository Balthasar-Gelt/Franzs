<?php

require_once 'nav-menu.php';
echo '<div class="menu_overlay">';
echo '<img src="'.'http://'. $_SERVER['SERVER_NAME'] .':'. $_SERVER['SERVER_PORT'] .'/Dealers/assets/other/clear.svg' .'" alt="Hey, Vsauce, image here">';
printNavMenu();
echo '</div>';