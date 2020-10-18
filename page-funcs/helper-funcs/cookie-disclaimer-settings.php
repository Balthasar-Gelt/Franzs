<?php

if($_GET['disclaimer_disable']){

    session_start();

    $_SESSION['cookies_disclaimer'] = 'disabled';
}