<?php

// Used as response to fetch calls
// 'code' - indicates if response is positive (1), warning (2), or error (3)
// 'answer' - text sent to be displayed
// 'errorType' - used for input validation, specifies which input was wrong, for example ('phone')

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