<?php

$response = array();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	if(isset($_POST['user_id']) ){
		
		require_once('../../incDB/usersAPI.php');
		
		$del = user_delete($_POST['user_id']);
		
		if((strcmp($del,"qry_u")) == 0){
			$response['error'] = false;
			$response['msg'] = "User is delete successfully";
		}else{
			$response['error'] = true;
			$response['msg'] = "Can't delete, please try again !!!";
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