<?php
require_once ('../incDB/db.php');

function create_user($name,$pass,$phone){
    Global $mp_handle;
    if(get_user_by_phone($phone)){
        return 1;
    }else{
        $password = md5($pass);
        $t = 0;

        $query = sprintf("INSERT INTO `users` VALUE (NULL,'%s',NULL,'%s',0, NULL, NULL, NULL, '%s')"
						 , $name,$password,$phone);
		$qresult = @mysqli_query($mp_handle,$query);
        if($qresult){
            return 2;
        }else{
            return 3;
        }
    }
}

function get_user_by_phone($phone){
    Global $mp_handle;
    $stmt = mysqli_query( $mp_handle ,"SELECT * FROM `users` WHERE `u_mobile` = '$phone'");
    return $result = mysqli_fetch_assoc($stmt);
}

function get_user_id_by_phone($phone){
    Global $mp_handle;
    $stmt = mysqli_query( $mp_handle ,"SELECT `u_id` FROM `users` WHERE `u_mobile` = '$phone'");
    return $result = mysqli_fetch_assoc($stmt);
}

function userLogin($phone,$pass){
    Global $mp_handle ;
    $password = md5($pass);
    $stmt = mysqli_query( $mp_handle ,"SELECT `u_id` FROM `users` WHERE `u_mobile` = '$phone' AND `u_pass` = '$password'");
    return mysqli_fetch_row($stmt) > 0 ;
}

function userUpdateInfo($id,$phone,$email,$name){
    Global $mp_handle ;
	
    $n_id = intval(mysqli_real_escape_string($mp_handle , strip_tags(trim($id))));
    $n_phone = intval(mysqli_real_escape_string($mp_handle , strip_tags(trim($phone))));
    $n_name = mysqli_real_escape_string($mp_handle , strip_tags(trim($name)));
    $n_email = mysqli_real_escape_string($mp_handle , strip_tags(trim($email)));
	
	$qry = sprintf("UPDATE `users` SET `u_name`= '%s',`u_email`= '%s',`u_mobile`= '%d' WHERE `u_id`= '%d'" , $n_name , $n_email , $n_phone , $n_id);
	$stmt = mysqli_query( $mp_handle , $qry);
    
	if($stmt){ return true; } else{ return false; }
}


function updatePassword($id,$pass){
    Global $mp_handle ;
	
    $n_id = intval(mysqli_real_escape_string($mp_handle , strip_tags(trim($id))));
    $n_pass = mysqli_real_escape_string($mp_handle , strip_tags(trim($pass)));
	$n_password = md5($n_pass);
	
	$qry = sprintf("UPDATE `users` SET `u_pass`= '%s' WHERE `u_id`= '%d'" , $n_password ,  $n_id);
	$stmt = mysqli_query( $mp_handle , $qry);
    
	if($stmt){ return true; } else{ return false; }
}

//function get_name_by_phone($phone){
//    Global $mp_handle ;
//    $stmt = mysqli_query( $mp_handle ,"SELECT * FROM `users` WHERE `u_mobile` = '$phone'");
//    return $result = mysqli_fetch_assoc($stmt);
//}
?>