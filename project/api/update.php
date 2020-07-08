<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../config/database.php';
    include_once '../info/info.php';
    
    $data = json_decode(file_get_contents("php://input"));

    if(!empty($data->id) && !empty($data->name) && !empty($data->email) && !empty($data->phone)){   
        $info->id = $data->id;
        $info->name = $data->name;
        $info->email = $data->email;
        $info->phone = $data->phone;
    }    
    if($info->update()){
        http_response_code(200);
        echo json_encode("infos updated.");
    } else{
        http_response_code(503);
        echo json_encode("infos could not be updated");
    }
?>