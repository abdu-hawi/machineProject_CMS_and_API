<?php
$response = array();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if( isset($_POST['user_id']) && isset($_POST['sys_id']) && isset($_POST['final_total_amt']) && 
					isset($_POST['json_items'])&& isset($_POST['date'])&& isset($_POST['payMethod'])){
        
        require_once ('../incDB/db.php');
        
        $userID = intval(mysqli_real_escape_string($mp_handle,strip_tags(trim($_POST['user_id']))));
        $sysID = intval(mysqli_real_escape_string($mp_handle,strip_tags(trim($_POST['sys_id']))));
        $final_total_amt = mysqli_real_escape_string($mp_handle,strip_tags(trim($_POST['final_total_amt'])));
        $json_items = mysqli_real_escape_string($mp_handle,strip_tags(trim($_POST['json_items'])));
		$date = mysqli_real_escape_string($mp_handle,strip_tags(trim($_POST['date'])));
		$pay_method = intval(mysqli_real_escape_string($mp_handle,strip_tags(trim($_POST['payMethod']))));
		$pait = 1;
		$mp_handle -> query("Begain Transaction");
		$stmt= $mp_handle->prepare("INSERT INTO `invoice` (`u_id`, `sm_id`, `inv_date`, 
								`inv_total`,`inv_pay_method`,`inv_pait`)
								VALUES (?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("iisdii",$userID,$sysID,$date,$final_total_amt,$pay_method,$pait);
		$stmt->execute();
		if($stmt){
			$lastID = mysqli_insert_id($mp_handle);
			$js = json_decode($_POST['json_items']);
			for($count=0 ; $count< count($js->recent) ; $count++){
				$item_id = trim($js->recent[$count]->IID);
				$item_qty = trim($js->recent[$count]->QTY);
				
				$qry_item= $mp_handle->prepare("INSERT INTO `invoice_item` (`inv_id`, `pi_id`, `ii_qty`)
											   VALUES (?, ?, ?)");
				$qry_item->bind_param("iii",$lastID,$item_id,$item_qty);
				$qry_item->execute();
				if($qry_item){
					$unicID = $lastID;
					$mp_handle->query("Commit");
					$response['error'] = false;
					$response['msg'] = $unicID;
					
				}else{
					//$mp_handle->query("DELETE FROM `tbl_order` WHERE `order_id` = ".$lastID);
					$mp_handle->query("Rollback Transaction");
					$response['error'] = true;
					$response['msg'] = 'Do not insert items';
				}
				
			} // end for loop
            /////////////////////////////
        }
        machine_db_close();
    }else{
        $response['error'] = true;
        $response['msg'] = 'All filed required';
    }
}else{
    $response['error'] = true;
    $response['msg'] = 'Cannot connect to server';
}

echo json_encode($response);

?>