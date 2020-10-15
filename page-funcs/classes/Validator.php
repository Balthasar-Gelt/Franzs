<?php

// Basic validator class
// $inputsToValidate - Associative array, keys are types of validations (functions) that are to be performed on their values
// for example ['email' => $emailInputValue] will call emailValidation function on $emailInputValue after calling validate function
// $response - If input value didnt go through a validation this will be returned

class Validator{

    protected $inputsToValidate; 
    protected $response;

    function __construct($inputs){

        $this->inputsToValidate = $inputs;
    }

// Validate is used for validating ALL inputs at once
// Returns error response on the very first input value that doesnt go through its validation function

    public function validate(){

        foreach ($this->inputsToValidate as $key => $input) {

            $func = (string)$key . 'Validation';
            $this->response = $this->$func($input);

            if($this->response !== true)
                break;
        }

        return $this->response;
    }

    protected function emailValidation($email){

        $sanitizedEmail = filter_var($email, FILTER_SANITIZE_EMAIL);

        if(filter_var($sanitizedEmail, FILTER_VALIDATE_EMAIL))
            return true;
        else
            return [2, 'Invalid email address', 'email'];
    }
}