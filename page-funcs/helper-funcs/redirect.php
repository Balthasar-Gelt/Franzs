<?php

function redirect($message = null){

    if(isset($_SERVER['HTTP_FETCH']))
        die($message);

    else{

        if(isset($_SERVER['HTTP_REFERER']))
            header('Location: '.$_SERVER['HTTP_REFERER']);

        else
            header('Location: http://localhost:8888/Franzs/index.php');

        die();
    }

}