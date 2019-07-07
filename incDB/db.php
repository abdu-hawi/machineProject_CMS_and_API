<?php

define('DB_NAME' , 'machine_project');
define('DB_HOST' , 'localhost');
define('DB_USER' , 'root');
define('DB_PASSWORD' , 'word6666');

// connect with sever

$mp_handle = @mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die('Could not connect...');

//die('OK');
//@mysql_close($tf_handle);

//-----------------------------------------------
// to used ARABIC language

@mysqli_query($mp_handle,"SET NAMES 'utf8'");
@mysqli_query($mp_handle,"SET CHARACTER SET utf8");  
@mysqli_query($mp_handle,"SET SESSION collation_connection = 'utf8_general_ci'"); 

function machine_db_close()
{
	global $mp_handle;
	mysqli_close($mp_handle);
}


//tinyf_db_close();

?>