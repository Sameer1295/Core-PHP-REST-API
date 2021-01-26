
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

//Category query
$result = $category->read();

//Get row count
$num = $result->rowCount();

//Check if any category is returned
if($num > 0){
    //Category array
    $category_arr = array();
    $category_arr['data'] = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        //using extract function to access $row['category_id'] as $category_id
        $category_item = array(
            'category_id' => $category_id,
            'category_name' => $category_name,
            'category_status' => $category_status,
        );
        //Push to data
        array_push($category_arr['data'],$category_item);
    }

    //turn to json and output
    echo json_encode(array('status'=>'true','data'=>$category_arr));
    http_response_code(200);
}else{
    //No category found
    echo json_encode(
        array('status'=>'false','message'=>'No Category found')
    );
    http_response_code(404);
}