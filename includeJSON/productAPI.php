<?php

require_once ('../incDB/db.php');

function getProduct($system,$section){
    Global $mp_handle;
    $myData = array();
    
    $n_sm = intval(mysqli_real_escape_string($mp_handle , strip_tags(trim($system))));
    $n_ps = intval(mysqli_real_escape_string($mp_handle , strip_tags(trim($section))));
	$stmt= $mp_handle->prepare("SELECT
                    `name`, `description`,SUM(`quantity`) AS `quantity`, `price`,
                    `image`,`sectionID`,`prodItemID`,`systemID`
                    FROM `prod` WHERE `sectionID` = '$n_ps' AND `systemID` = '$n_sm'
                    GROUP BY `prodItemID`
                        ");
    $stmt->execute();
    $result = $stmt->get_result();
    
    while($row = $result->fetch_assoc() ){
        $myData[] = $row;
    }
    
    return $myData;
}

function getProductDetail($system,$productID){
    Global $mp_handle;
    $myData = array();
    
    $n_sm = intval(mysqli_real_escape_string($mp_handle , strip_tags(trim($system))));
    $n_pi = intval(mysqli_real_escape_string($mp_handle , strip_tags(trim($productID))));

	$stmt= $mp_handle->prepare("SELECT
                    `name`, `description`, SUM(`quantity`) AS `quantity`, `image`,
                    `sectionID`, `price`, `production_prod`, `expire_prod`, `prodItemID`,
                    `systemID` FROM `prod_detail` WHERE `prodItemID` = '$n_pi' AND `systemID` = '$n_sm'
                    GROUP BY `prodItemID`
                        ");
    $stmt->execute();
    $result = $stmt->get_result();
    
    while($row = $result->fetch_assoc() ){
        $myData[] = $row;
    }
    
    return $myData;
}

?>