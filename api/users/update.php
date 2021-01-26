<?php
//Headers
header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');
header('Access-Control-Allow-Methods:PUT');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Users.php';

//Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//Instantiate Category object
$user = new Users($db);

//get raw posted data
$data = json_decode(file_get_contents("php://input"));

//set id to update
$user->user_id = $data->user_id;

//add values from data to Users
$user->user_name = $data->user_name;
$user->user_phone = $data->user_phone;
$user->user_email = $data->user_email;
$user->user_password = $data->user_password;

//Update Category
if($user->update()){
    echo json_encode(
        array('message' => 'User Updated')
    );
    http_response_code('200');
}else{
    echo json_encode(
        array('message' => 'User Not Updated')
    );
    http_response_code('400');
}