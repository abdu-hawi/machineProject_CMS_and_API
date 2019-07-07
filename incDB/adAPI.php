<?php


	function ad_get()
	{
		global $mp_handle;
		$myData = array();
		
		$stmt= $mp_handle->prepare("SELECT * FROM `advertising` ");
		$stmt->execute();
		$result = $stmt->get_result();
		while($row = $result->fetch_assoc() ){
			$myData[] = $row;
		}
		mysqli_close($mp_handle);
		return json_encode($myData, JSON_UNESCAPED_UNICODE);
		mysqli_free_result($stmt);
		
	}
	
	function ad_get_by_name($name)
	{
		global $mp_handle;
		$pi_name    = @mysqli_real_escape_string($mp_handle,strip_tags($name));
		
		$result = mysqli_query($mp_handle , "SELECT * FROM `advertising` WHERE `ad_img_name` = '$pi_name'");
		$rows = mysqli_fetch_row($result);
		//$rows = $result->fetch_object();
		if($rows != NULL)
			$qry = $rows;
		else
			$qry = NULL;
		
		//mysqli_close($mp_handle);
		return $qry;
	}
	
	
	function ad_add($img)
	{
		global $mp_handle;
		
		if ( empty($img) )
			return false;
		
		$n_img   = @mysqli_real_escape_string($mp_handle,strip_tags($img));
		
		$query = sprintf("INSERT INTO `advertising` VALUE (NULL,'%s')"
						 , $n_img);
		$qresult = @mysqli_query($mp_handle,$query);
		
		mysqli_close($mp_handle);
		if(!$qresult)
			return false;
			
		return true;
	} // END machine_admin_add function
	
	require_once('db.php');
	
	

	
?>