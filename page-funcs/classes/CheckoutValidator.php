<?php

require 'ExtendedValidator.php';

class CheckoutValidator  extends ExtendedValidator{

    protected function cardNumberValidation($cardNumber){
        
        $cardNumber = $this->trimAllWhiteSpace($cardNumber);

        if(!$this->checkLength($cardNumber, 15, 19))
            return [2, 'Invalid card number length', 'card_number'];
        
        if(ctype_digit($cardNumber))
            return true;
        else
            return [2, 'Invalid card number', 'card_number'];
    }

    protected function cardExpirationDateValidation($cardExpirationDate){

        $cardExpirationDate = $this->trimAllWhiteSpace($cardExpirationDate);

        if(!$this->checkLength($cardExpirationDate, 7, 7))
            return [2, 'Invalid expiration date', 'card_expiration'];
        
        if(!ctype_digit(str_replace("/","",$cardExpirationDate)))
            return [2, 'Invalid expiration date', 'card_expiration'];

        $dateArray = preg_split('/\//',$cardExpirationDate);

        if(!$this->checkDate($dateArray[1], $dateArray[0]))
            return [2, 'Card expired', 'card_expiration'];
        else
            return true;
    }

    protected function cardSecurityCodeValidation($cardSecurityCode){
        
        $cardSecurityCode = $this->trimAllWhiteSpace($cardSecurityCode);

        if(!$this->checkLength($cardSecurityCode, 3, 4))
            return [2, 'Invalid security code length', 'card_security_code'];
        
        if(ctype_digit($cardSecurityCode))
            return true;
        else
            return [2, 'Invalid security code', 'card_security_code'];
    }

    private function checkDate($year, $month){

        if(date('Y m') > $year . ' ' . $month)
            return false;
        else
            return true;
    }
}