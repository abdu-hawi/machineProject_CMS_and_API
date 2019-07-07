<?php

	function invoice_get_by_user_id($invID)
	{
		global $mp_handle;
		$response = array();
		$myData = array();
		$cac = array();
		
		$n_id    = @mysqli_real_escape_string($mp_handle,strip_tags($invID));
		$stmt= $mp_handle->prepare("SELECT `ID`,`DATE`,`TOTAL`,`sName`,`METHOD` FROM `inv` WHERE `USER` = ".$n_id);
		$stmt->execute();
		$result = $stmt->get_result();
		while($row = $result->fetch_assoc() ){
			$myData[] = $row;
		}
		
		for($n = 0 ; $n < count($myData) ; $n++){
			$prod = '';
			$response['id'] = $myData[$n]['ID'];
			$response['total'] = $myData[$n]['TOTAL'];
			$response['sm'] = $myData[$n]['sName'];
			$response['date'] = $myData[$n]['DATE'];
			$response['method'] = $myData[$n]['METHOD'];
			
			//// make for loop for product
			$pro = invoice_product_get_by_id($myData[$n]['ID']);
			foreach($pro as $p){
				if(count($pro) > 1)
					$prod .= $p['prodName'].' , ';
				else
					$prod = $p['prodName'];
			}
			$response['prod'] = substr($prod,0,20);
			$cac[] = $response;
		}
		//mysqli_close($mp_handle);
		return $cac;
		mysqli_free_result($stmt);
		
	}
	
	function invoice_product_get_by_id($invID)
	{
		global $mp_handle;
		$myData = array();
		$n_id    = @mysqli_real_escape_string($mp_handle,strip_tags($invID));
		$stmt= $mp_handle->prepare("SELECT prodName FROM `inv_detail` where InvID = ".$n_id);
		$stmt->execute();
		$result = $stmt->get_result();
		while($row = $result->fetch_assoc() ){
			$myData[] = $row;
		}
		//mysqli_close($mp_handle);
		return $myData;
		mysqli_free_result($stmt);
		
	}

	
	function invoice_detail_get_by_id($invID)
	{
		global $mp_handle;
		$myData = array();
		$n_id    = intval(mysqli_real_escape_string($mp_handle,strip_tags($invID)));
		$stmt= $mp_handle->prepare("SELECT `prodName`,`qty`,`price` FROM `inv_detail` WHERE `InvID` = ".$n_id);
		$stmt->execute();
		$result = $stmt->get_result();
		while($row = $result->fetch_assoc() ){
			$myData[] = $row;
		}
		//mysqli_close($mp_handle);
		return $myData;
		mysqli_free_result($stmt);
		
	}
	
require_once ('../incDB/db.php');

	
?>