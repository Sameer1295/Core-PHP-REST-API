<?php
//Headers
header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');

include_once '../../config/Database.php';
include_once '../../models/Users.php';

//Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//Instantiate Category object
$user = new Users($db);

//Get id from url, if not present in url then die
$user->user_id = isset($_GET['user_id'])?$_GET['user_id']:die();

//get category
$user->readSingle();

//create array, put values using $category into keys
$user_arr = array(
    'user_id' => $user->user_id,
    'user_name' => $user->user_name,
    'user_phone' => $user->user_phone,
    'user_email' => $user->user_email,
);



//make it to json
print_r(json_encode(array('response code'=>'200','status'=>'true','data' => $user_arr)));