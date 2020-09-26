<?php

require '../page-funcs/helper-funcs/sentinel-use.php';
require '../page-funcs/helper-funcs/redirect.php';
require '../page-funcs/helper-funcs/answer.php';

use Cartalyst\Sentinel\Native\Facades\Sentinel;

$response = [];
$inputValidation = false;

if(validateEmail($_POST['register_email'])){

    if(checkPasswordLength()){

        if(checkPasswordMatch()){
            $inputValidation = true;
        }
        else{
            $response = [2, "Passwords do not match", "repeat_password"];
            $inputValidation = false;
        }
    }
    else{
        $response = [2, "Password must be longer than 5 characters", "password"];
        $inputValidation = false;
    }

}
else{
    $response = [2, "Invalid email", "email"];
    $inputValidation = false;
}



if($inputValidation){

    $credentials = [
        'email' => filter_var($_POST['register_email'], FILTER_SANITIZE_EMAIL),
        'password' => $_POST['register_password'],
    ];

    if(!(Sentinel::findByCredentials(['login' => $credentials['email']]))){

        if(Sentinel::registerAndActivate($credentials)){
            $response = [1, "User registered"];

            Sentinel::authenticate($credentials);
        }
        else{
            $response = [3, "Could not register user"];
        }
    }
    else
        $response = [2, "User {$credentials['email']} already exists", "email"];
}

redirect(answer($response));




function checkPasswordLength(){

    return strlen($_POST['register_password']) > 5;
}

function checkPasswordMatch(){

    return $_POST['register_password'] == $_POST['form_repeat_password'];
}

function validateEmail($email){

    $sanitizedEmail = filter_var($email, FILTER_SANITIZE_EMAIL);

    return filter_var($sanitizedEmail, FILTER_VALIDATE_EMAIL);
}