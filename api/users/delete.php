<?php
//Headers
header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');
header('Access-Control-Allow-Methods:DELETE');
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

//delete Category
if($user->delete()){
    echo json_encode(
        array('message' => 'Category deleted')
    );
}else{
    echo json_encode(
        array('message' => 'Category Not deleted')
    );
}