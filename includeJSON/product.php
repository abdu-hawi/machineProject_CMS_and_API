<?php

$response = array();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(!isset($_POST['system']) || !isset($_POST['section'])){
        $response['error'] = true;
        $response['msg'] = 'Some Mistake';
        die(json_encode($response));
    }
    
    require_once ('productAPI.php');
    $myData = getProduct($_POST['system'],$_POST['section']);
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