<?php

	function product_get(){
		global $mp_handle;
		
		$qry = mysqli_query($mp_handle,"SELECT * FROM `product_item`");
		if(!$qry){
			return NULL;
		}
		if( mysqli_num_rows($qry) > 0){
			return $qry;
		}
	}
	
	function product_get_by_name($name)
	{
		global $mp_handle;
		$pi_name    = @mysqli_real_escape_string($mp_handle,strip_tags($name));
		$result = mysqli_query($mp_handle , "SELECT * FROM `product_item` WHERE `pi_name` = '$pi_name'");
		$rows = mysqli_fetch_row($result);
		if($rows != NULL)
			$qry = $rows;
		else
			$qry = NULL;
			
		return $qry;
	}
	
	function product_get_by_id($id)
	{
		global $mp_handle;
		$myData = array();
		
		$pi_id    = mysqli_real_escape_string($mp_handle,strip_tags($id));
		$str = sprintf("SELECT * FROM `product` WHERE `ID` = %d", $pi_id);
		$stmt= $mp_handle->prepare($str);
		$stmt->execute();
		$result = $stmt->get_result();
		while($row = $result->fetch_assoc() ){
			$myData[] = $row;
		}
		return json_encode($myData, JSON_UNESCAPED_UNICODE);
		mysqli_free_result($stmt);
		
	}
	
	
	function product_add($name,$sec,$desc,$price,$img)
	{
		global $mp_handle;
		
		if ( empty($name) || empty($desc) || empty($img) || empty($sec) || empty($price))
			return false;
		
		$n_name    = @mysqli_real_escape_string($mp_handle , strip_tags($name));
		$n_desc    = @mysqli_real_escape_string($mp_handle,strip_tags($desc));
		$n_sec    = @mysqli_real_escape_string($mp_handle,strip_tags($sec));
		$n_price    = @mysqli_real_escape_string($mp_handle,strip_tags($price));
		$n_img   = @mysqli_real_escape_string($mp_handle,strip_tags($img));
		$query = sprintf("INSERT INTO `product_item` VALUE (NULL,'%s','%s','%s','%s','%s')"
						 , $n_name, $n_desc, $n_price, $n_img,$n_sec);
		$qresult = @mysqli_query($mp_handle,$query);
		
		if(!$qresult)
			return false;
			
		return true;
	} // END product_add function
	
	
	function product_detail_add($sm,$item,$qty,$pro,$exp)
	{
		global $mp_handle;
		
		if ( empty($sm) || empty($item) || empty($qty) || empty($pro) || empty($exp))
			return false;
		
		$n_sm    = intval(mysqli_real_escape_string($mp_handle , strip_tags($sm)));
		$n_item    = intval(mysqli_real_escape_string($mp_handle , strip_tags($item)));
		$n_qty    = intval(mysqli_real_escape_string($mp_handle , strip_tags($qty)));
		$n_pro    = @mysqli_real_escape_string($mp_handle,strip_tags($pro));
		$n_exp   = @mysqli_real_escape_string($mp_handle,strip_tags($exp));
		
		$query = sprintf("INSERT INTO `product_item` VALUE (NULL,'%d','%s','%s','%d','%d')"
						 , $n_qty, $n_pro, $n_exp, $n_item,$n_sm);
		$qresult = @mysqli_query($mp_handle,$query);
		
		if(!$qresult)
			return false;
			
		return true;
	} // END product_detail_add function
	
	function delete_product_by_section($secID){
		global $mp_handle;
		
		if ( empty($secID) )
			return false;
		
		$n_secID =  intval(mysqli_real_escape_string($mp_handle , strip_tags($secID)));
		
		$qry = mysqli_query($mp_handle,"SELECT `pi_id` FROM `product_item` WHERE `ps_id` = " .$n_secID);
		$row = mysqli_fetch_row($qry);
		if($row != NULL){
			while($n_pID = mysqli_fetch_assoc($qry)){
				$n_productID = n_pID['pi_id'];
				if(delete_product_detail_by_prodID($n_productID)){
					$query = sprintf("DELETE FROM `product_item` WHERE `ps_id` = %d" ,$n_secID);
					$qresult = @mysqli_query($mp_handle,$query);
					if(!$qresult){
						return false;
					}
				}else{
					return false;
				}
			}
		}
		return true;
		
	}
	
	/// start delete product
	function delete_product($productID){
		global $mp_handle;
		
		if ( empty($productID) )
			return false;
		
		$n_productID =  intval(mysqli_real_escape_string($mp_handle , strip_tags($productID)));
		
		mysqli_autocommit($mp_handle,false);
		
		if(delete_product_detail_by_prodID($n_productID)){
			$query = sprintf("DELETE FROM `product_item` WHERE `pi_id` = " .$n_productID);
			$qresult = @mysqli_query($mp_handle,$query);
			if(!$qresult){
				mysqli_rollback($mp_handle);
				return false;
			}else{
				mysqli_commit($mp_handle);
				return true;
			}
		}else{
			mysqli_rollback($mp_handle);
			return false;
		}
	}
	
	function delete_product_detail_by_prodID($productID){
		// pid_id  pi_id   sm_id
		//DELETE FROM `product_item_detail` WHERE `pid_id` = 9 AND `pi_id`=33 AND `sm_id` = ''
		
		global $mp_handle;
		
		if ( empty($productID) )
			return false;
		
		$n_productID =  intval(mysqli_real_escape_string($mp_handle , strip_tags($productID)));
		$result = mysqli_query($mp_handle,"SELECT `pi_id` FROM `product_item_detail` WHERE`pi_id`= ".$n_productID);
		$rows = mysqli_fetch_row($result);
		if($rows != NULL){
			$query = sprintf("DELETE FROM `product_item_detail` WHERE `pi_id`= " .$n_productID);
			$qresult = @mysqli_query($mp_handle,$query);
			if(!$qresult)
				return false;
			else
				return true;
		}else{
			return true;
		}
	}
	
	function product_update($id,$name,$sec,$desc,$price,$img)
	{
		global $mp_handle;
		
		if ( empty($id) || empty($name) || empty($desc) || empty($img) || empty($sec) || empty($price))
			return false;
		
		$n_id    = @mysqli_real_escape_string($mp_handle , strip_tags($id));
		$n_name    = @mysqli_real_escape_string($mp_handle , strip_tags($name));
		$n_desc    = @mysqli_real_escape_string($mp_handle,strip_tags($desc));
		$n_sec    = @mysqli_real_escape_string($mp_handle,strip_tags($sec));
		$n_price    = @mysqli_real_escape_string($mp_handle,strip_tags($price));
		$n_img   = @mysqli_real_escape_string($mp_handle,strip_tags($img));
		/*
		UPDATE `product_item` SET `pi_id`=[value-1],`pi_name`=[value-2],`pi_desc`=[value-3],
		`pi_price`=[value-4],`pi_img`=[value-5],`ps_id`=[value-6] WHERE 1
		
		$query = sprintf("UPDATE `product_item` SET `pi_name`= %s,`pi_desc`= %s,
		`pi_price`= %d,`pi_img`= %s,`ps_id`= %d WHERE `pi_id`= %d" , $n_name , $n_desc , $n_price , $n_img , $n_sec , $n_id);
		*/
		$query = "UPDATE `product_item` SET `pi_name`= '$name' ,`pi_desc`= '$n_desc',
		`pi_price`= '$n_price' ,`pi_img`= '$n_img' ,`ps_id`= '$n_sec' WHERE `pi_id`= ".$n_id;
		$qresult = @mysqli_query($mp_handle,$query);
		
		if(!$qresult)
			return false;
			
		return true;
	} // END product_add function
	
	
	require_once('db.php');
	
	

	
?>