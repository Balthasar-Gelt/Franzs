<?php

require '../page-funcs/classes/DB.php';
require '../page-funcs/classes/ExtendedValidator.php';
require '../page-funcs/helper-funcs/sentinel-use.php';
require '../page-funcs/helper-funcs/redirect.php';
require '../page-funcs/helper-funcs/answer.php';
require '../variables/dbConfig.php';

use Cartalyst\Sentinel\Native\Facades\Sentinel;

if(!Sentinel::check())
    redirect();

$inputsForValidation = [
    'email' => (string)$_POST['form_email'],
    'phone' => (string)$_POST['form_phone']
];

$db = new DB($dbConfig);
$validator = new ExtendedValidator($inputsForValidation);

$response = $validator->validate();

if($response === true){
    
    if(updateUserData((object)$_POST))
        $response = [1, 'Data updated'];
    else
        $response = [3, 'Could not update user data'];
}

redirect(answer($response));



function updateUserData($data){

$dbData = [$data->form_email, $data->form_first_name, $data->form_last_name,
$data->form_street, $data->form_city, $data->form_province,
$data->form_country, $data->form_post, $data->form_phone];

    global $db;

    return $db->updateRow("UPDATE USERS SET email = ?, first_name = ?, last_name = ?,
                        street_address = ?, city = ?, province = ?, 
                        country = ?, postal_code = ?, phone_number = ?
                        WHERE id = " . Sentinel::getUser()->id, $dbData);
}