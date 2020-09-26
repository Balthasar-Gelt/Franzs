<?php

class CartManager{

    private $cart = [],
            $db;

    function __construct(array $cart, DB $db){

        $this->cart = $cart;
        $this->db = $db;
    }

    public function addToCart($item){

        if($this->checkForDuplicity($item))
            return [2, 'This product is already in your cart'];
        
        else{
            $this->addToSession($item);
            $this->adddToCookie($item);

            return [1, 'Product added to cart'];
        }
    }

    public function deleteFromCart($item){

        if(!empty($this->cart)){

            $response = [
                'cartTotal' => $this->recountCartTotal($item),
                'itemStatus' => $this->checkItemStatus($item),
                'isEmpty' => $this->isEmptyCartAfterDelete($item)
            ];

            $this->deleteFromSession($item);
            $this->deleteFromCookie($item);

            return [1, $response];
        }
        return [2, 'Cart is already empty'];
    }

    public function emptyCart()
    {
        if (session_status() == PHP_SESSION_NONE)
            session_start();

        $_SESSION['productId'] = null;

        setcookie('cartProduct', "", (time() - 100), '/');
    }
    
    //
    //  ADD TO CART RELATED FUNCTIONS
    //

    public function checkForDuplicity($value){

        return in_array($value, $this->cart);
    }

    //
    //  SESSION FUNCTION
    //

    private function addToSession($value){

        if (session_status() == PHP_SESSION_NONE)
            session_start();
    
        $_SESSION['productId'][] = $value;
    }
    
    //
    //  COOKIE FUNCTIONS
    //
    
    private function adddToCookie($value){
    
        if(!isset($_COOKIE['cartProduct'])){
    
            $arr = [];
            $arr[] = $value;
    
            $this->setNewCookie(serialize($arr));
        }
            
        else{
    
            $newCookieValue = array();
    
            if(!empty($_COOKIE['cartProduct']))
                $newCookieValue = unserialize($_COOKIE['cartProduct']);
    
            $newCookieValue[] = $value;
    
            $this->setNewCookie(serialize($newCookieValue));
        }
    }
    
    private function setNewCookie($product){
    
        setcookie('cartProduct', $product, time() + (86400 * 7), '/' );
    }

    //
    //  DELETE FROM CART RELATED FUNCTIONS
    //

    private function isEmptyCartAfterDelete($itemToExclude){

        $newCart = [];

        foreach ($this->cart as $item) {
            
            if($item == $itemToExclude)
                continue;
            
            $newCart[] = $item;
        }

        return empty($newCart);
    }

    public function checkItemStatus($itemToExclude = null){

        $itemStatus = [];

        foreach($this->cart as $itemId) {
            
            if($itemId == $itemToExclude)
                continue;

            $itemStatus[] = $this->db->fetchRow("SELECT Status FROM PRODUCTS WHERE id = ?", [$itemId])->Status;
        }

        return $itemStatus;
    }

    private function recountCartTotal($itemToExclude){

        $newCartTotal = 0;

        foreach($this->cart as $itemId) {
            
            if($itemId == $itemToExclude)
                continue;

            $newCartTotal += (float) $this->db->fetchRow("SELECT Price FROM PRODUCTS WHERE id = ?", [$itemId])->Price;
        }

        return $newCartTotal;
    }

    private function findAndDeleteProduct($array, $product){
        
        foreach ($array as $key => $productId) {
    
            if($productId == $product){
                unset($array[$key]);
                break;
            }
        }
        return $array;
    }

    //
    //  DELETE FROM SESSION
    //

    private function deleteFromSession($value){

        if (session_status() == PHP_SESSION_NONE)
            session_start();

        if(!empty($_SESSION['productId']) && in_array($value, $_SESSION['productId']))
            $_SESSION['productId'] = $this->findAndDeleteProduct($_SESSION['productId'], $value);
        

    }

    //
    //  DELETE FROM COOKIE
    //
    
    private function deleteFromCookie($value){
    
        $unserializedCookie = unserialize($_COOKIE['cartProduct']);

        if(in_array($value, $unserializedCookie)){
    
            $unserializedCookie = $this->findAndDeleteProduct($unserializedCookie, $value);
    
            if(!empty($unserializedCookie))
                setcookie('cartProduct', serialize($unserializedCookie), time() + 259200000, '/');
    
            else
                setcookie('cartProduct', " ", time() - 100, '/');
        }
    }
}