<?php

if(!isset($_SESSION['cookies_disclaimer'])){

    echo '<div class="disclaimer">
            <span>This site uses cookies. By using this site you will be providing consent to our use of cookies.</span>
            <a href="page-funcs/helper-funcs/cookie-disclaimer-settings.php?disclaimer_disable=true"><img src="assets/other/remove-24px.svg" alt="delete"></a>
        </div>';
}