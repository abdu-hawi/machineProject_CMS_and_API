<?php

require_once('session.php');

if( (!isset($_POST['userName'])) || (!isset($_POST['password'])) )
{
	die('BAD ACCESS');
}

require_once('db.php');
require_once('usersAPI.php');

if( empty ($_POST['userName']) || empty ($_POST['password']) )
{
	machine_db_close();
	die('FILL INFO');
}

$user = machine_users_get_by_name($_POST['userName']);

if(!$user)
{
	machine_db_close();
	die('BAD USER');
}
if(($user[4]) != 1 ){
	die('BAD USER');
}
//md5(mysqli_real_escape_string($mp_handle,strip_tags($password)))
$pass = md5(mysqli_real_escape_string($mp_handle,strip_tags($_POST['password'])));
machine_db_close();

if( strcmp ($pass , $user[3]) != 0 )
{
	die('BAD PASS');
}

$user[3] = 0;
$_SESSION['userinfo'] = $user;

header ('Location:../cms/main.php');

?>