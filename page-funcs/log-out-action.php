<?php

require 'helper-funcs/sentinel-use.php';
require 'helper-funcs/answer.php';
require 'helper-funcs/redirect.php';

use Cartalyst\Sentinel\Native\Facades\Sentinel;

$response = [];

if(Sentinel::check()){

    if(Sentinel::logout())
        $response = [1,'User logged out'];
    else
        $response = [3,'User could not be logged out'];
}
else
    $response = [2,'No user is logged in'];

redirect(answer($response));