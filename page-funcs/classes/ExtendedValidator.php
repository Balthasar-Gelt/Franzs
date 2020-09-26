<?php

require 'Validator.php';

class ExtendedValidator extends Validator{

    protected function phoneValidation($number){

        $number = $this->trimAllWhiteSpace($number);

        if(!$this->checkLength($number, 10, 20))
            return [2, 'Invalid phone length', 'phone'];
    
        if($this->checkFirstChar($number[0])){
    
            $substr = substr($number, 1);
            
            if(ctype_digit($substr))
                return true;
            else
                return [2, 'Invalid phone number', 'phone'];
        }
        else
            return [2, 'Invalid phone number', 'phone'];
    }

    protected function checkLength($number, $min, $max){
    
        if(strlen($number) < $min || strlen($number) > $max)
            return false;
        else
            return true;
    }

    protected function checkFirstChar($firstChar){

        return (ctype_digit($firstChar) || $firstChar == '+');
    }

    protected function trimAllWhiteSpace($string){

        return preg_replace('/\s+/', '', $string);
    }
}