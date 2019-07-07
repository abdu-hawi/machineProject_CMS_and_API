<?php

$response = array();
if($_SERVER['REQUEST_METHOD'] != 'POST'){
	$response['error'] = true;
	$response['msg'] = 'Request faild, please try agin';
	die(json_encode($response));
}
if(!isset($_POST['typeName']) && !isset($_POST['userID']) &&
	!isset($_POST['userName']) && !isset($_POST['userEmail']) &&
	!isset($_POST['userMobile']) ){
		$response['error'] = true;
		$response['msg'] = 'Request faild, please try agin';
		die(json_encode($response));
	}
		
if(!strcmp($_POST['typeName'],"dd")){
	$response['error'] = true;
	$response['msg'] = " <span id='invalid'><b>Please select user type</b></span> ";
	die(json_encode($response));
}

require_once('../../incDB/usersAPI.php');

// insert to db
$n_name = trim($_POST['userName']);
$n_type = trim($_POST['typeName']);
$n_id = trim($_POST['userID']);
$n_mail = trim($_POST['userEmail']);
$n_phone = trim($_POST['userMobile']);

$result = user_update($n_id,$n_name,$n_type,$n_mail,$n_phone);

machine_db_close();

if($result){
	$response['error'] = false;
	$response['msg'] = 'okUpdate';
}
else{
	$response['error'] = true;
	$response['msg'] = $_POST['itemName'] . " <span id='invalid'><b>can't updateing user, please try again.</b></span> ";
	die(json_encode($response));
}

echo json_encode($response);

?>