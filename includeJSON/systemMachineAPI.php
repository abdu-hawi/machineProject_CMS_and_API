<?php
require_once ('../incDB/db.php');



function get_sm(){
    Global $mp_handle;
    
    $myData= array();
	$stmt= $mp_handle->prepare(" SELECT * FROM `system_machine`");
    $stmt->execute();
    $result = $stmt->get_result();
    
    while($row = $result->fetch_assoc() ){
        $myData[] = $row;
    }
    
    return $myData;
    
}

function getSystemIdByName($name){
    Global $mp_handle;
    $stmt = mysqli_query( $mp_handle ,"SELECT `sm_id` AS `ID` FROM `system_machine` WHERE `sm_name` = '$name'");
    return $result = mysqli_fetch_assoc($stmt);
}


?>