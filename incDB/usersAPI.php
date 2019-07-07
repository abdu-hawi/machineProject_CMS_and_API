<?php

	function user_get(){
		global $mp_handle;
		
		$qry_sm = mysqli_query($mp_handle,"SELECT * FROM `users`");
		if(!$qry_sm){
			return NULL;
		}
		if( mysqli_num_rows($qry_sm) > 0){
			return $qry_sm;
		}
	}
	
	function user_get_by_id($id)
	{
		global $mp_handle;
		$myData = array();
		
		$pi_id    = intval(mysqli_real_escape_string($mp_handle,strip_tags($id)));
		$str = sprintf("SELECT `u_name` AS `name`, `u_email` AS `email` , `u_type` AS `type` , `u_mobile` AS `mobile`
				FROM `users` WHERE `u_id` = %d", $pi_id);
		$stmt= $mp_handle->prepare($str);
		$stmt->execute();
		$result = $stmt->get_result();
		while($row = $result->fetch_assoc() ){
			$myData[] = $row;
		}
		return json_encode($myData, JSON_UNESCAPED_UNICODE);
		mysqli_free_result($stmt);
		
	}
	
	function user_delete($id){
		global $mp_handle;
		$uID = intval(mysqli_real_escape_string($mp_handle,strip_tags($id)));
		$qry = sprintf("DELETE FROM `users` WHERE `u_id` = ".$uID );
		$qry_u = mysqli_query($mp_handle,$qry);
		if(!$qry_u)
			return false;
		else
			return "qry_u";
		
	}
	
	function user_update($id,$name,$type,$email,$mobile)
	{
		global $mp_handle;
		
		if ( empty($id) || empty($name) || empty($type) || empty($email) || empty($mobile) )
			return false;
		
		$n_id    = intval(mysqli_real_escape_string($mp_handle , strip_tags($id)));
		$n_name    = @mysqli_real_escape_string($mp_handle , strip_tags($name));
		$n_type    = intval(mysqli_real_escape_string($mp_handle,strip_tags($type)));
		$n_email    = @mysqli_real_escape_string($mp_handle,strip_tags($email));
		$n_mobile    = intval(mysqli_real_escape_string($mp_handle,strip_tags($mobile)));
		
		$query = "UPDATE `users` SET `u_name`= '$name' ,`u_type`= '$n_type',
		`u_email`= '$n_email' ,`u_mobile`= '$n_mobile'  WHERE `u_id`= ".$n_id;
		$qresult = @mysqli_query($mp_handle,$query);
		
		if(!$qresult)
			return false;
			
		return true;
	} // END product_add function

	function machine_users_get($extra = '')
	{
		
		global $mp_handle;
		$query = " SELECT * FROM `users` '.$extra.' " ;
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
	
	function machine_users_get_by_id($uid)
	{
		// used for cryptography
		$id = (int)$uid;
		if($id == 0 )
			return NULL;
			
		$result = machine_users_get('WHERE `u_id` =' .$id);
		if($result == NULL)
			return NULL;
			
		$user = $result[0];
		return $user;
		
	}// END machine_users_get_by_id function
	
	function machine_users_get_by_name($name)
	{
		global $mp_handle;
		$n_name    = @mysqli_real_escape_string($mp_handle,strip_tags($name));
		
		$result = mysqli_query($mp_handle , "SELECT * FROM `users` WHERE `u_name` = '$n_name'");
		$rows = mysqli_fetch_row($result);
		//$rows = $result->fetch_object();
		if($rows != NULL)
			$qry = $rows;
		else
			$qry = NULL;
			
		return $qry;
	}
	
	function machine_users_get_by_email($email)
	{
		global $mp_handle;
		$n_email    = @mysqli_real_escape_string($mp_handle,strip_tags($name));
		
		$result = machine_users_get("WHERE `u_email` = '$n_email'");
		
		if($n_email != NULL)
			$user = $result[0];
		else
			$user = NULL;
			
		return $user;
	}
	
	function machine_admin_add($name,$password,$email)
	{
		
		global $mp_handle;
		
		if ( empty($name) || empty($password) || empty($email) )
			return false;
		
		$n_email   = @mysqli_real_escape_string($mp_handle,strip_tags($email));
		
		if(!filter_var($n_email,FILTER_VALIDATE_EMAIL))
			return false;
		
		$n_name    = @mysqli_real_escape_string($mp_handle , strip_tags($name));
		$n_pass    = md5(mysqli_real_escape_string($mp_handle,strip_tags($password)));
		$query = sprintf("INSERT INTO `users` VALUE (NULL,'%s','%s','%s',1, NULL, NULL, NULL, NULL)"
						 , $n_name  , $n_email, $n_pass);
		$qresult = @mysqli_query($mp_handle,$query);
		
		if(!$qresult)
			return false;
			
		return true;
	} // END machine_admin_add function
	
	function machine_users_add($name,$password,$email)
	{
		
		global $mp_handle;
		
		if ( empty($name) || empty($password) || empty($email) )
			return false;
		
		$n_email   = @mysqli_real_escape_string($mp_handle,strip_tags($email));
		
		if(!filter_var($n_email,FILTER_VALIDATE_EMAIL))
			return false;
		
		$n_name    = @mysqli_real_escape_string($mp_handle , strip_tags($name));
		$n_pass    = md5(mysqli_real_escape_string($mp_handle,strip_tags($password)));
		$query = sprintf("INSERT INTO `users` VALUE (NULL,'%s','%s','%s',0, NULL, NULL, NULL, NULL)"
						 , $n_name , $n_email , $n_pass);
		$qresult = @mysqli_query($mp_handle,$query);
		
		if(!$qresult)
			return false;
			
		return true;
	} // END machine_users_add function
	
	require_once('db.php');
	
	

	////////////////////////////////////////////
	// TO ADD USER
	/*//////////////////////////////////////////
	$result = tinyf_users_add('salem','1fsdf23','abs@basa.com',0);
	if($result)
	{
		tinyf_db_close();
		echo('DONE');
	}   
	*/
	/////////////////////////////////////////////////
	// TO GET ALL users
	/*/////////////////////////////////////////////////
	$users = tinyf_users_get();
	tinyf_db_close();
	echo '<pre>'; // TO MAKE ARRAY IN SCHEDUAL
    print_r($users); // TO print ARRAY
	echo '</pre>';
	*/
	//////////////////////////////////////////////////
	// TO GET USER INFO BY ID
	/*////////////////////////////////////////////
	$user= tinyf_users_get_by_id(1);
	tinyf_db_close();
	if($user != NULL)
	{
		echo'<pre>';
		print_r($user);
		echo'</pre>';
	}
	else{
		echo'USER ID IS NOT CORRECT';
	}
	*/
	///////////////////////////////////////////////
	// TO DELETE USER
	/*/////////////////////////////////////////////
	$result = tinyf_users_delete(8);
	tinyf_db_close();
	if($result)
		echo 'DELETE';
	*/
	//////////////////////////////////////////////////
	// TO UPDATE USER INFO
	/*////////////////////////////////////////////////	
	$result = tinyf_users_update(1,'Abdu','123456','abdu@hawi.com',1);
	if($result)
		echo'success or';
	*//////////////////////////////////////////////////	
	
?>