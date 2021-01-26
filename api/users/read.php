<?php

//Headers
header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');

include_once '../../config/Database.php';
//model for which function is created for
include_once '../../models/Users.php';

//Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//create object of user and pass db connection string to Users construct
$user = new Users($db);

//call read function and store in result
$result = $user->read();

//get row count
$num = $result->rowCount();

//Check if any category is returned
if($num > 0){
    //Category array
    $user_arr = array();
    $user_arr['data'] = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        //using extract function to access $row['category_id'] as $category_id
        $user_item = array(
            'user_id' => $user_id,
            'user_name' => $user_name,
            'user_email' => $user_email,
            'user_phone' => $user_phone
        );
        //Push to data
        array_push($user_arr['data'],$user_item);
    }

    //turn to json and output
    echo json_encode($user_arr);
}else{
    //No category found
    echo json_encode(
        array('message'=>'No Category found')
    );
}
?>