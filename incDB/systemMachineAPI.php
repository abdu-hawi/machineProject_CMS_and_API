<?php

	function system_get($extra = '')
	{
		
		global $mp_handle;
		$query = " SELECT * FROM `system_machine` '.$extra.' " ;
		$qresult = @mysqli_query($mp_handle,$query);
		if(!$qresult)
			return NULL;
		
		$rcount = @mysqli_num_rows($qresult);
		if($rcount == 0)
			return NULL;
			
		$users = array();
		for( $i = 0 ; $i < $rcount ; $i++ )
		{
			$users[@count($users)] = @mysqli_fetch_object($qresult);
		}
		
		@mysqli_free_result($qresult);
		
		return $users;
		
	} // END machine_users_get function
	
	function sm_get(){
		global $mp_handle;
		
		$qry_sm = mysqli_query($mp_handle,"SELECT * FROM `system_machine`");
		if(!$qry_sm){
			return NULL;
		}
		if( mysqli_num_rows($qry_sm) > 0){
			return $qry_sm;
		}
	}
	
	function sm_delete($sm_id){
		global $mp_handle;
		
		$n_id = intval($sm_id);
		$qry_sm = mysqli_query($mp_handle,"DELETE FROM `system_machine` WHERE `sm_id` = ".$n_id);
		machine_db_close();
		if($qry_sm){
			return "qry_sm";
		}
	}
	
	
	
	function sm_get_by_name($name)
	{
		global $mp_handle;
		$n_name    = @mysqli_real_escape_string($mp_handle,strip_tags($name));
		
		$result = mysqli_query($mp_handle , "SELECT * FROM `system_machine` WHERE `sm_name` = '$n_name'");
		$rows = mysqli_fetch_row($result);
		//$rows = $result->fetch_object();
		if($rows != NULL)
			$qry = $rows;
		else
			$qry = NULL;
			
		return $qry;
	}
	
	function sm_get_by_id($id)
	{
		global $mp_handle;
		$n_id    = intval(mysqli_real_escape_string($mp_handle,strip_tags($id)));
		
		$result = mysqli_query($mp_handle , "SELECT * FROM `system_machine` WHERE `sm_id` = '$n_id'");
		if($result != NULL)
			$qry = $result;
		else
			$qry = NULL;
			
		return $qry;
	}
	
	
	function sm_add($name,$dist,$lat,$long)
	{
		global $mp_handle;
		
		if ( empty($name) || empty($dist) || empty($lat) || empty($long) )
			return false;
		
		$n_name    = @mysqli_real_escape_string($mp_handle , strip_tags($name));
		$n_dist    = @mysqli_real_escape_string($mp_handle,strip_tags($dist));
		$n_lat  = @mysqli_real_escape_string($mp_handle,strip_tags($lat));
		$n_long  = @mysqli_real_escape_string($mp_handle,strip_tags($long));
		/*
		//INSERT INTO `system_machine` (`sm_id`, `sm_name`, `sm_dist`, `sm_lat`, `sm_long`) VALUES (NULL, '', '', '', '');
		$query = sprintf("INSERT INTO `system_machine` VALUE (NULL,'%s','%s','%s,'%s')"
						 , $n_name  , $n_dist, $n_lat , $n_long);
		*/
		
		$str = "INSERT INTO `system_machine` (`sm_id`, `sm_name`, `sm_dist`, `sm_lat`, `sm_long`) 
							VALUES (NULL, '$n_name', '$n_dist', '$n_lat', '$n_long');";
		$qresult = @mysqli_query($mp_handle,$str);
		
		if(!$qresult)
			return false;
			
		return true;
	} // END sm_add function
	
	// get by lat & long
	
	function sm_get_by_lat_long($lat,$long)
	{
		global $mp_handle;
		$n_lat    = @mysqli_real_escape_string($mp_handle,strip_tags($lat));
		$n_long    = @mysqli_real_escape_string($mp_handle,strip_tags($long));
		
		$result = mysqli_query($mp_handle , "SELECT * FROM `system_machine` WHERE `sm_lat` = '$n_lat'");
		$rows = mysqli_fetch_row($result);
		//$rows = $result->fetch_object();
		if($rows != NULL){
			$qry = $rows;
		}else{
			$resLong = mysqli_query($mp_handle , "SELECT * FROM `system_machine` WHERE `sm_long` = '$n_long'");
			$rowsLong = mysqli_fetch_row($resLong);
			if($rowsLong != NULL){
				$qry = $rowsLong;
			}else{
				$qry = NULL;
			}
		}
		return $qry;
	}
	
	// end get by lat & long
	
	require_once('db.php');
	
	

	
?>