<?php
require_once('../../incDB/session.php');
if($_SESSION['userinfo'] == false) header ('Location:../../index.php');

$response = array();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	if(isset($_POST['machineName']) && isset($_POST['itemName']) && isset($_POST['itemQTY']) &&
			isset($_POST['prodDate']) && isset($_POST['expDate'])){
		
		if(!strcmp($_POST['machineName'],"dd")){
			$response['error'] = true;
			$response['msg'] = " <span id='invalid'><b>Please select Machine</b></span> ";
			die(json_encode($response));
		}
		if(!strcmp($_POST['itemName'],"dd")){
			$response['error'] = true;
			$response['msg'] = " <span id='invalid'><b>Please select Item</b></span> ";
			die(json_encode($response));
		}
		
		// check for item name in db
		require_once('../../incDB/db.php');
		require_once('../../incDB/productItemAPI.php');
		
		// insert to db
		$n_sm = trim($_POST['machineName']);
		$n_item = trim($_POST['itemName']);
		$n_qty = trim($_POST['itemQTY']);
		$n_pro = trim($_POST['prodDate']);
		$n_exp = trim($_POST['expDate']);
		
		$result = product_detail_add($n_sm,$n_item,$n_qty,$n_pro,$n_exp);
		
		machine_db_close();
		
		if($result){
			$response['error'] = false;
			$response['msg'] = 'ok';
		}
		else{
			$response['error'] = true;
			$response['msg'] = $_POST['itemName'] . " <span id='invalid'><b>can't insert item, please try again.</b></span> ";
			die(json_encode($response));
		}
		// end insert to db
		
	}else{// end if isset
		$response['error'] = true;
		$response['msg'] = 'Request faild, please try agin';
	}// end else of if iseet
}else{// end if request
	$response['error'] = true;
	$response['msg'] = 'Request faild, please try agin';
} // end else of if request


echo json_encode($response);

?>