<?php
require_once('../incDB/session.php');
if($_SESSION['userinfo'] == false) header ('Location:../index.php');

$response = array();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if( isset($_POST['idAD']) ){
        require_once('../incDB/db.php');
		$img;
		$id = intval($_POST['idAD']);
		GLOBAL $mp_handle;
		/////////////////
		$str = sprintf("SELECT `ad_img_name` FROM `advertising` WHERE `ad_id` = '%d'" ,$id);
		$qry = mysqli_query($mp_handle,$str);
		while($r = mysqli_fetch_array($qry)) {$img = $r['ad_img_name'];}
		//////////////////
		$strDel = sprintf("DELETE FROM `advertising` WHERE `ad_id` = '%d'" ,$id);
		$qryDel = mysqli_query($mp_handle,$strDel);
		
		if( $qryDel ){
			$response['error'] = false;
			unlink("imgAD/".$img);
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

