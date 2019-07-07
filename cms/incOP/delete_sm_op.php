<?php

$response = array();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	if(isset($_POST['sm_id']) ){
		
		
		//require_once('../../incDB/db.php');
		require_once('../../incDB/systemMachineAPI.php');
		
		$del = sm_delete($_POST['sm_id']);
		
		if((strcmp($del,"qry_sm")) == 0){
			$response['error'] = false;
			$response['msg'] = 'OK';
		}else{
			$response['error'] = true;
			$response['msg'] = 'Request failed, please try again';
		}
		
		
	}else{// end if isset
		$response['error'] = true;
		$response['msg'] = 'Request failed, please try again';
	}// end else of if iseet
}else{// end if request
	$response['error'] = true;
	$response['msg'] = 'Request failed, please try again';
} // end else of if request


echo json_encode($response);

?>