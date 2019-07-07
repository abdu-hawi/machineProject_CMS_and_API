<?php

$response = array();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(!isset($_POST['dd'])){
        $response['error'] = true;
        $response['msg'] = 'Some Mistake';
        die(json_encode($response));
    }
    
    require_once ('../incDB/db.php');
    Global $mp_handle;
    $myData = array();
    
	$stmt= $mp_handle->prepare("SELECT `ad_img_name` AS `name` FROM `advertising` ");
    $stmt->execute();
    $result = $stmt->get_result();
    
    while($row = $result->fetch_assoc() ){
        $myData[] = $row;
    }
	
	mysqli_close($mp_handle);
	
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