<?php


	function invoice_get()
	{
		global $mp_handle;
		$myData = array();
		
		$stmt= $mp_handle->prepare("SELECT * FROM `inv` ");
		$stmt->execute();
		$result = $stmt->get_result();
		while($row = $result->fetch_assoc() ){
			$myData[] = $row;
		}
		//mysqli_close($mp_handle);
		return json_encode($myData, JSON_UNESCAPED_UNICODE);
		mysqli_free_result($stmt);
		
	}
	
	function invoice_get_by_id($invID)
	{
		global $mp_handle;
		$myData = array();
		$n_id    = @mysqli_real_escape_string($mp_handle,strip_tags($invID));
		$stmt= $mp_handle->prepare("SELECT * FROM `inv` WHERE `ID` = ".$n_id);
		$stmt->execute();
		$result = $stmt->get_result();
		while($row = $result->fetch_assoc() ){
			$myData[] = $row;
		}
		//mysqli_close($mp_handle);
		return json_encode($myData, JSON_UNESCAPED_UNICODE);
		mysqli_free_result($stmt);
		
	}
	
	function invoice_detail_get_by_id($invID)
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
		return json_encode($myData, JSON_UNESCAPED_UNICODE);
		mysqli_free_result($stmt);
		
	}
	
	
	
	
	require_once('db.php');
	
	

	
?>