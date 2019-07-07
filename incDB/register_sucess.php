<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="../include/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../include/fonts/font-awesome.min.css">
<title>Machine Project</title>

</head>

<!--   style="font-size:large;" -->
<body style="background-color:#fafafa;">

<style>
.con-mar-top{
	margin-top:3em;
	float:right;
	text-align:right;
}
.form-control{
	text-align: right;
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
		
		<div class="alert alert-success">
				 تم تسجيل المستخدم بنجاح لتسجيل الدخول <strong><a href="../index.php">إضغط هنا</a></strong>
		</div>
    </div>
</div>



</body>
</html>
<!--
<script type="text/javascript">
	$(document).ready(function(){
					var da_form = $('#add_user').serialize();
					$.post('saveUser.php',da_form,function(data){
								//okInsert value is coming from post.add.php if is true insert to db
								if(data == 'okInsert'){
									$('#show').html('<div class=\'ok\'>تمت إضافة الخبر بنجاح</div>');
								}else{
									$('#show').html(data);
								}
					});
	});
</script>
-->