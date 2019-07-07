<?php
require_once('../incDB/session.php');
if($_SESSION['userinfo'] == false) header ('Location:../index.php');

$response = array();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if( isset($_POST['id']) ){
        require_once('../incDB/productItemAPI.php');
		$row = product_get_by_id($_POST['id']);
		$sJson = json_decode($row, true);
		$img;
		foreach($sJson as $pi){
			$img = $pi['IMG'];
			echo $img;
		}
		if( delete_product($_POST['id']) ){
			$response['error'] = false;
			unlink("upload/".$img);
			$response['img'] = "upload/".$img;
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

