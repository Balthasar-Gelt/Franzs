<?php

class IndexPage{

    private $properties = [
        'title' => null,
        'subTitle' => null,
        'titlePictureName' => null,
        'bottomRowImageName' => null,
        'bottomRowTitle' => null,
        'products' => null
    ],
    $db;

    function __construct(DB $db){

        $this->db = $db;

        foreach ( $this->properties as $key => $property ) {
            
            if($key == 'products'){
                $this->properties[$key] = $this->fillProductsArray();

                continue;
            }

            $this->properties[$key] = $this->db->fetchRow("SELECT ". $key ." FROM mainPage")->$key;
        }
    }

    private function fillProductsArray(){

        $products = [];
        $idsOfProducts = $this->db->fetchRows("SELECT productId FROM mainPageProducts");

        foreach ($idsOfProducts as $key => $id) {
            
            $products[$key] = $this->db->fetchRow("SELECT * FROM PRODUCTS WHERE ID = " . $id->productId);
        }

        return $products;
    }

    public function getProperty($property){
        
        return $this->properties[$property];
    }
}