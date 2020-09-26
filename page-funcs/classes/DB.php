<?php

class DB{
    
    private $db,
            $fetchType = PDO::FETCH_OBJ;

    function __construct($dbConfig){

        $this->db = new PDO("{$dbConfig['type']}:host={$dbConfig['host']};dbname={$dbConfig['name']}",
        $dbConfig['user'],
        $dbConfig['password']);

        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    }

    public function setDBAttribute($attribute, $value){

        $this->db->setAttribute($attribute, $value);
    }

    public function setFetchType($type){

        $this->fetchType = $type;
    }

    public function fetchRow($query, $values = []){

        return $this->query($query, $values)->fetch($this->fetchType);
    }

    public function fetchRows($query, $values = []){

        return $this->query($query, $values)->fetchAll($this->fetchType);
    }

    public function updateRow($query, $values = []){

        return $this->query($query, $values); 
    }

    private function query($query, $values = []){
  
        if(!empty($values)){

            $query = $this->db->prepare($query);
            $query->execute($values);
            return $query;
        }

        else
            return $this->db->query($query);
    }
}