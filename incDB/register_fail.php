<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="../include/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../include/fonts/font-awesome.min.css">
<title>Create new admin account</title>

</head>

<style>


</style>
<!--   style="font-size:large;" -->
<body style="background-color:#fafafa;">


<style>
.con-mar-top{
	margin-top:3em;
}
.form-control{
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
		
		<div class="alert alert-danger">
				<strong>Error!</strong> can't add ADMIN please try again
		</div>
		<br/>
    	<form method="post" id="add_user" action="saveUser.php">
    	<div class="panel panel-primary">
        	<div class="panel-heading">
            	New admin account
            </div>
            <div class="panel-body">
            	<input class="form-control" type="text" placeholder="Admin name" name="userName" />
                <input class="form-control" type="password" placeholder="Passowrd" name="password" />
                <input class="form-control" type="email" placeholder="E-mail" name="email" />
                <a href="../index.php" class="pull-right">Log in</a>
                <br/><br/>
                <button class="btn btn-primary btn-block" id="register" type="submit" name="submit">Create new admin account</button>
            </div><!-- End panel bode -->
        </div><!-- End panel -->
        </form>
    </div>
</div>



</body>
</html>
