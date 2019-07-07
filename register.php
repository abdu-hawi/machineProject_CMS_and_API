<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="include/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="include/fonts/font-awesome.min.css">
<title>Create new admin account</title>
<script src="include/js/jquery-3.2.1.min.js"></script>
<script src="include/js/bootstrap-3.3.7.min.js"></script>

</head>

<style>

.navbar-header{
	float:right !important
}

.navbar-login {
    background-color: #24b9a5;
    border-bottom: 1px solid #000;
    padding-bottom: 10px;
    padding-top: 10px;
}
</style>
<!--   style="font-size:large;" -->
<body style="background-color:#fafafa;">

<nav class="navbar navbar-inverse">
  <div class="container-fluid pull-left">
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
	<div class="col-lg-4 col-md-6 hidden-xs con-mar-top"></div>
	
	<div class="col-lg-4  col-md-6 col-sm-12 col-xs-12 con-mar-top">
		
		<div id="show"></div>
		<br/>
    	<form method="post" id="add_user" action="incDB/saveUser.php">
    	<div class="panel panel-primary">
        	<div class="panel-heading">
            	<b>Create new admin account</b>
            </div>
            <div class="panel-body">
            	<input class="form-control" type="text" placeholder="Admin name" name="userName" />
                <input class="form-control" type="password" placeholder="Password" name="password" />
                <input class="form-control" type="email" placeholder="E-mail" name="email" />
                <a href="index.php" class="pull-right">Log in</a>
                <br/><br/>
                <button class="btn btn-primary btn-block" id="register" type="submit" name="submit">Process new admin</button>
            </div><!-- End panel bode -->
        </div><!-- End panel -->
        </form>
    </div>
</div>



</body>
</html>
