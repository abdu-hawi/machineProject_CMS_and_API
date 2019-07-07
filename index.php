<?php

//require_once('include_db/session.php');
//$_SESSION['fail'] = false;

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="include/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="include/fonts/font-awesome.min.css">
<title>Log in</title>
<script src="include/js/jquery-3.2.1.min.js"></script>
<script src="include/js/bootstrap-3.3.7.min.js"></script>

</head>

<body style="background-color:#fafafa;">

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <span class="navbar-brand" style="padding-top:0.8em;">System Machine Project</span>
    </div>		
  </div>
</nav>


<style>
.con-mar-top{
	margin-top:3em;
    /*
	float:right;
	text-align:right;
	*/
}
.form-control{
	/*text-align: right;*/
	margin-bottom:10px;	
}

.ok{
	background:#deffdf; 
	padding:12px; 
	width:90%; 
	border:1px solid #00b304; 
	margin-left:auto; 
	margin-right:auto; 
	color:#707d28;
	border-radius:7px;	
}
.no{
	background:#ffdede; 
	padding:12px; 
	width:90%; 
	border:1px solid #d30000; 
	margin-left:auto; 
	margin-right:auto; 
	color:#ff0000;
	border-radius:7px;
}
</style>

<div>
    <div class="col-lg-2 col-md-1 hidden-xs con-mar-top"></div>
    <div class="col-lg-2 col-md-1 hidden-xs con-mar-top"></div>
	<div class="col-lg-4  col-md-5 col-sm-12 col-xs-12 con-mar-top">
    	<form method="post" action="incDB/checkLogin.php">
    	<div class="panel panel-info">
        	<div class="panel-heading">
            	<b>Log in</b>
            </div>
            <div class="panel-body">
            	<input class="form-control" type="text" placeholder="User name" name="userName" />
                <input class="form-control" type="password" placeholder="Password" name="password" />
                <!--
                <a href="rest_password.php" class="pull-left">Forget password</a> --><a href="register.php" class="pull-right">Create new account</a>
            
                <br/><br/>
                <button class="btn btn-info btn-block" type="submit" name="submit">Process</button>
            </div><!-- End panel bode -->
        </div><!-- End panel -->
        </form>
    </div>
    
    
</div>




</body>
</html>
