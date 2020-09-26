<?php

function answer($response){

    if(sizeof($response) == 2){
        $answer = array(
            'code' => $response[0],
            'answer' => $response[1],
            'errorType' => 'none'
        );
    }
    else{
        $answer = array(
            'code' => $response[0],
            'answer' => $response[1],
            'errorType' => $response[2]
        );
    }
    
    return json_encode($answer);
}