<?php
//Headers
header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');
header('Access-Control-Allow-Methods:PUT');
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

//set id to update
$category->category_id = $data->category_id;

//add values from data to category
$category->category_name = $data->category_name;
$category->category_status = $data->category_status;

//Update Category
if($category->update()){
    echo json_encode(
        array('message' => 'Category Updated')
    );
}else{
    echo json_encode(
        array('message' => 'Category Not Updated')
    );
}