<?php
require_once('../incDB/session.php');
if($_SESSION['userinfo'] == false) header ('Location:../index.php');

$response = array();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if( isset($_POST['id']) ){
        require_once('../incDB/itemSectionAPI.php');
		if( delete_section($_POST['id'],0) ){
			$response['error'] = false;
		}else{
			$response['error'] = true;
			$response['msg'] = "can not delete";
		}
		
    }else{
		$response['error'] = true;
        $response['msg'] = 'All filed required';
    }
}else{
	$response['error'] = true;
    $response['msg'] = 'Cannot connect to server';
}
echo json_encode($response);
?>

