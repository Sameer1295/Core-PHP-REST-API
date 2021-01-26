<?php
//Headers
header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');
header('Access-Control-Allow-Methods:POST');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

//Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//Instantiate Category object
$category = new Category($db);

//get raw posted data
$data = json_decode(file_get_contents("php://input"));

//add values from data to category
$category->category_name = $data->category_name;
$category->category_status = $data->category_status;

//Create Category
if($category->create()){
    echo json_encode(
        array('message' => 'Category Created')
    );
    // http_response_code(200);
}else{
    echo json_encode(
        array('message' => 'Category Not Created')
    );
    // http_response_code(200);
}