<?php

// Import the necessary classes
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Illuminate\Database\Capsule\Manager as Capsule;
use Cartalyst\Sentinel\Activations\IlluminateActivationRepository as Activation;

// Include the composer autoload file
require $_SERVER['DOCUMENT_ROOT'] . '/Dealers/vendor/autoload.php';

// Setup a new Eloquent Capsule instance
$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => 'Dealers',
    'username'  => 'root',
    'password'  => 'root',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
]);

$capsule->bootEloquent();