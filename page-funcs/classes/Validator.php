<?php

class Validator{

    protected $inputsToValidate;
    protected $response;

    function __construct($inputs){

        $this->inputsToValidate = $inputs;
    }

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