<?php
$response = array();
if($_SERVER['REQUEST_METHOD'] != 'POST'){
	$response['error'] = true;
	$response['msg'] = " <span id='invalid'><b>Request failed, please try again.</b></span> ";
	die(json_encode($response));
}
if( (!isset($_POST['smName'])) || (!isset($_POST['distName'])) || (!isset($_POST['lat'])) || (!isset($_POST['long'])) )
{
	$response['error'] = true;
	$response['msg'] = " <span id='invalid'><b>All fields are required.</b></span> ";
	die(json_encode($response));
}

require_once('../../incDB/systemMachineAPI.php');

$n_name = trim($_POST['smName']);
$n_dist = trim($_POST['distName']);
$n_lat = trim($_POST['lat']);
$n_long = trim($_POST['long']);

$ress = sm_add($n_name,$n_dist,$n_lat,$n_long);

if($ress){
	$response['error'] = false;
	$response['msg'] = 'ok';
	$response['res'] = $ress;
}else{
	$response['error'] = true;
	$response['msg'] = " <span id='invalid'><b> Can't adding new system machine, please try again !!!</b></span> ";
	$response['res'] = $ress;
	die(json_encode($response));
}

echo json_encode($response);
?>