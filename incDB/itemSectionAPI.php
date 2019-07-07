<?php


	function section_get()
	{
		global $mp_handle;
		$myData = array();
		
		$stmt= $mp_handle->prepare("SELECT * FROM `product_section` ");
		$stmt->execute();
		$result = $stmt->get_result();
		while($row = $result->fetch_assoc() ){
			$myData[] = $row;
		}
		return json_encode($myData, JSON_UNESCAPED_UNICODE);
		mysqli_free_result($stmt);
		
	}
	
	function section_get_by_name($name)
	{
		global $mp_handle;
		$pi_name    = @mysqli_real_escape_string($mp_handle,strip_tags($name));
		
		$result = mysqli_query($mp_handle , "SELECT * FROM `product_section` WHERE `ps_name` = '$pi_name'");
		$rows = mysqli_fetch_row($result);
		//$rows = $result->fetch_object();
		if($rows != NULL)
			$qry = $rows;
		else
			$qry = NULL;
			
		return $qry;
	}
	
	function section_get_by_id($id)
	{
		global $mp_handle;
		$myData = array();
		
		$s_id    = mysqli_real_escape_string($mp_handle,strip_tags($id));
		$str = sprintf("SELECT * FROM `product_section` WHERE `ps_id` = %d", $s_id);
		$stmt= $mp_handle->prepare($str);
		$stmt->execute();
		$result = $stmt->get_result();
		while($row = $result->fetch_assoc() ){
			$myData[] = $row;
		}
		return json_encode($myData, JSON_UNESCAPED_UNICODE);
		mysqli_free_result($stmt);
		
	}
	
	
	function section_add($name,$img)
	{
		global $mp_handle;
		
		if ( empty($name) ||  empty($img) )
			return false;
		
		$n_name    = @mysqli_real_escape_string($mp_handle , strip_tags($name));
		$n_img   = @mysqli_real_escape_string($mp_handle,strip_tags($img));
		
		$query = sprintf("INSERT INTO `product_section` VALUE (NULL,'%s','%s')"
						 , $n_name  ,  $n_img);
		$qresult = @mysqli_query($mp_handle,$query);
		
		if(!$qresult)
			return false;
			
		return true;
	} // END machine_admin_add function
	
	
	function delete_section($secID,$isAv){
		global $mp_handle;
		
		if ( empty($secID) )
			return false;
		
		$n_secID =  intval(mysqli_real_escape_string($mp_handle , strip_tags($secID)));
		$n_isAv =  intval(mysqli_real_escape_string($mp_handle , strip_tags($isAv)));
		
		mysqli_autocommit($mp_handle,false);
		
		$query = sprintf("UPDATE `product_section` SET `isAvilable` = %d WHERE `ps_id` = %d" ,$n_isAv,$n_secID);
		$qresult = @mysqli_query($mp_handle,$query);
		if(!$qresult){
			mysqli_rollback($mp_handle);
			return false;
		}else{
			mysqli_commit($mp_handle);
			return false;
		}
		
	function section_update($id,$name,$img)
	{
		global $mp_handle;
		
		if ( empty($id) || empty($name) || empty($img) )
			return false;
		
		$n_id    = @mysqli_real_escape_string($mp_handle , strip_tags($id));
		$n_name    = @mysqli_real_escape_string($mp_handle , strip_tags($name));
		$n_img   = @mysqli_real_escape_string($mp_handle,strip_tags($img));
		
		$query = "UPDATE `product_section` SET `ps_name`= '$n_name' ,`ps_image`= '$n_img'  WHERE `ps_id`= ".$n_id;
		$qresult = @mysqli_query($mp_handle,$query);
		
		if(!$qresult)
			return false;
			
		return true;
	} 
		
		/*
		require_once('productItemAPI.php');

		if(delete_product_by_section($n_secID)){
			$query = sprintf("DELETE FROM `product_section` WHERE `ps_id` = %d" ,$n_secID);
			$qresult = @mysqli_query($mp_handle,$query);
			if(!$qresult){
				mysqli_rollback($mp_handle);
				return false;
			}else{
				mysqli_commit($mp_handle);
				return false;
			}
		}else{
			mysqli_rollback($mp_handle);
			return true;
		}
		*/
	}
	
	require_once('db.php');
	
	

	
?>