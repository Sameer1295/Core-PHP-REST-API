<?php
//Headers
header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

//Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//Instantiate Category object
$category = new Category($db);

//Get id from url, if not present in url then die
$category->id = isset($_GET['id'])?$_GET['id']:die();

//get category
$category->readSingle();

//create array, put values using $category into keys
$category_arr = array(
    'category_id' => $category->id,
    'category_name' => $category->name,
    'category_status' => $category->status,
);

//make it to json
print_r(json_encode($category_arr));