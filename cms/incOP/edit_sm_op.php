<?php
$response = array();
if( (!isset($_POST['smName'])) || (!isset($_POST['smID'])) || (!isset($_POST['distName'])) || (!isset($_POST['lat'])) || (!isset($_POST['long'])) )
{
	$response['error'] = true;
	$response['msg'] = " <span id='invalid'><b>All fields are required.</b></span> ";
	die(json_encode($response));
}

require_once('../../incDB/systemMachineAPI.php');

global $mp_handle;

$n_name = trim(mysqli_real_escape_string($mp_handle,strip_tags($_POST['smName'])));
$n_dist = trim(mysqli_real_escape_string($mp_handle,strip_tags($_POST['distName'])));
$n_lat = trim(mysqli_real_escape_string($mp_handle,strip_tags($_POST['lat'])));
$n_long = trim(mysqli_real_escape_string($mp_handle,strip_tags($_POST['long'])));
$n_id = intval(trim(mysqli_real_escape_string($mp_handle,strip_tags($_POST['smID']))));

//UPDATE `system_machine` SET `sm_id`=[value-1],`sm_name`=[value-2],`sm_dist`=[value-3],`sm_lat`=[value-4],`sm_long`=[value-5] WHERE 1

$result = @mysqli_query($mp_handle,"UPDATE `system_machine` SET
						`sm_name`='$n_name',`sm_dist`='$n_dist',
						`sm_lat`='$n_lat',`sm_long`='$n_long'
						WHERE `sm_id`=".$n_id);

machine_db_close();

if($result){
	$response['error'] = false;
	$response['msg'] = 'ok';
}else{
	$response['error'] = true;
	$response['msg'] = " <span id='invalid'><b> Can't update system machine, please try again !!!</b></span> ";
	die(json_encode($response));
}

echo json_encode($response);
?>