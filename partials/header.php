<?php

if (session_status() == PHP_SESSION_NONE)
    session_start();

require_once 'nav-menu.php';
require_once 'variables/baseUrl.php';
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href=" <?php echo BASE_URL . '/dist/main.css'; ?> ">
    <title>Eshop with antiquities</title>
</head>

<body>

    <nav>

        <div class="container nav_container">        
            <h1><a href="index.php">Franzs</a></h1>

            <?php printNavMenu(); ?>

            <img class="menu_icon" src="<?php echo BASE_URL . '/assets/other/menu.svg'; ?>" alt="Hey, Vsauce, image here">
        </div>

    </nav>

<?php
include_once 'responsive-menu.php';
include_once 'search.php'; 
include_once 'log-in-register-forms.php';
include_once 'messages.php';
include_once 'cookies-disclaimer.php';
?>