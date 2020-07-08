<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json; charset=UTF-8');

    include_once '../config/database.php';
    include_once '../info/info.php';

    $stmt = $info->read();
    $num = $stmt->rowCount();

    if($num > 0){
        $infos_arr = array();
        $infos_arr['Informations'] = array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $info_item = array('id'=>$id, 'name'=>$name, 'email'=>$email, 'phone'=>$phone);
            array_push($infos_arr['Informations'], $info_item);
        }
        
        echo json_encode($infos_arr);
    }
    else{
       
        echo json_encode(array('message'=>'nothing'));
    }
?>