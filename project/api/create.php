<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../info/info.php';

    $data = json_decode(file_get_contents("php://input"));
    
    if(!empty($data->name) && !empty($data->email) && !empty($data->phone)){
        $info->name = $data->name;
        $info->email = $data->email;
        $info->phone = $data->phone;
    } 
    if($info->create()){
        http_response_code(201);
        echo 'New info created successfully.';
    } else{
        http_response_code(503);
        echo 'New info could not be created.';
    }
?>