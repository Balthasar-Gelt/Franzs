<?php

class Cart{

    private $cart = [],
            $cartTotal = 0,
            $db;

    function __construct(DB $db){

        $this->db = $db;

        $this->cart = $this->fillCart();
        $this->countCartTotal();
    }

    public function getCartTotal($shipping = 0){

        return $this->cartTotal + $shipping;
    }

    public function getCartItems(){

        return $this->cart;
    }

    private function fillCart(){

        $cart = [];
    
        if (session_status() == PHP_SESSION_NONE)
            session_start();
    
        if(!empty($_SESSION['productId'])){
    
            $cart = $_SESSION['productId'];
    
            if(isset($_COOKIE['cartProduct']) && !empty($_COOKIE['cartProduct']))
                $cart = array_unique(array_merge($cart, unserialize($_COOKIE['cartProduct'])));
        }
    
        else{
    
            if(isset($_COOKIE['cartProduct']) && !empty($_COOKIE['cartProduct']))
                $cart = unserialize($_COOKIE['cartProduct']);
        }

        return $cart;
    }

    private function countCartTotal(){
    
        if(!empty($this->cart)){
    
            foreach ($this->cart as $productId) {

                $productPrice = $this->db->fetchRow("SELECT Price FROM PRODUCTS WHERE id = ?", [$productId])->Price;

                $this->cartTotal += (float) $productPrice;
            }
        }
    }
}