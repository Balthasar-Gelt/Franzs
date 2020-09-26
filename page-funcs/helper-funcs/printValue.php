<?php

function printValue($object, $property){

    if($object == null)
        echo '';

    else 
        echo $object->$property;
}