<?php

$response = array();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
require_once ('../incDB/db.php');
Global $mp_handle;
    $myData = array();
	$stmt= $mp_handle->prepare("SELECT * FROM `product_section`  WHERE `isAvilable` = 0");
    $stmt->execute();
    $result = $stmt->get_result();
    
    while($row = $result->fetch_assoc() ){
        $myData[] = $row;
    }
	if(count($myData) != 0){
        $response['error'] = false;
        $response['msg'] = $myData;
    }else{
        $response['error'] = true;
        $response['msg'] = 'We Found Some Mistake';
    }
}else{
    $response['error'] = true;
    $response['msg'] = 'Cannot connect to server';
}

echo json_encode($response);

?>