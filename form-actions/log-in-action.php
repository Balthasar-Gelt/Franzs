<?php

require '../page-funcs/helper-funcs/sentinel-use.php';
require '../page-funcs/helper-funcs/redirect.php';
require '../page-funcs/helper-funcs/answer.php';

use Cartalyst\Sentinel\Native\Facades\Sentinel;

$response = [];

if(!Sentinel::check()){

    if(validateEmail()){

        $credentials = [
            'email' => filter_var($_POST['log_in_email'], FILTER_SANITIZE_EMAIL),
            'password' => $_POST['log_in_password'],
        ];

        if((Sentinel::findByCredentials(['login' => $credentials['email']]))){
        
            if(Sentinel::authenticate($credentials))
                $response = [1, "User logged in"];
            else
                $response = [2, "Wrong password", 'password'];
        }
        else
            $response = [3, "User does not exist"];
    }
    else
        $response = [2, "Invalid email", 'email'];
}
else
    $response = [3, "Another user is still logged in"];

redirect(answer($response));

function validateEmail(){

    $sanitizedEmail = filter_var($_POST['log_in_email'], FILTER_SANITIZE_EMAIL);

    return filter_var($sanitizedEmail, FILTER_VALIDATE_EMAIL);
}