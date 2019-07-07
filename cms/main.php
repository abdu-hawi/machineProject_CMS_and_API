<?php
require_once('../incDB/session.php');
if($_SESSION['userinfo'] == false) header ('Location:../index.php');
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">

<link rel="stylesheet" type="text/css" href="../include/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../include/dataTable/datatables.min.css">
<link rel="stylesheet" type="text/css" href="../include/fonts/font-awesome.min.css">

<title>System Machine Project</title>

<script src="../include/js/jquery-3.2.1.min.js"></script>
<script src="../include/js/bootstrap-3.3.7.min.js"></script>
<script src="../include/dataTable/jquery.dataTables.min.js"></script>
<!--
<script src="abdu.js"></script>
-->
</head>

<body style="background-color:#fff;" lang="en">

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <span class="navbar-brand" style="padding-top:0.8em;">System Machine Project</span>
    </div>
				<div class="collapse navbar-collapse" id="myNavbar">
					<ul class="nav navbar-nav nav-sm">
							<li class="active"><a href="#system_machine" id="system_machine" data-toggle="tab">System Machine</a></li>
							<li><a href="#product_section" id="product_section" data-toggle="tab">Product Section</a></li>
							<li><a href="#advertising" id="advertising" data-toggle="tab">Advertising</a></li>
							<li><a href="#invoice" id="invoice" data-toggle="tab">Invoices</a></li>
							<li><a href="#users" id="users" data-toggle="tab">Users</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
							<li><a href="../incDB/logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
					</ul>
				</div>
  </div>
</nav>
<!--   style="font-size:x-large;"  -->
 <div class="navbar-default" >
    
      <div class="col-lg-2 col-md-2 col-sm-3">
        <ul class="nav navbar-nav nav-sm">
          <li><a href="#add_system_machine" id="add_system_machine">Add System Machine</a></li>
          <li><a href="#add_product_section" id="add_product_section">Add Product Section</a></li>
          <li><a href="#add_product_items" id="add_product_items">Add Product Items</a></li>
          <li><a href="#add_product_items_details" id="add_product_items_details">Add Product Item Details</a></li>
          <li><a href="#add_advertising" id="add_advertising">Add Advertising</a></li>
        </ul>
      </div>
    
 </div>

  
<div class="col-lg-10-inv col-lg-10 col-md-10 col-sm-9" id="asid-down" style="background:#fff;">
	<?php //echo $order_id; ?>
	    
	<div class="tab-content container">
		
		<div id="system_machine" class="tab-pane fade in active"> 
		</div>
		<div id="product_section" class="tab-pane fade">
		</div>
		<div id="invoice" class="tab-pane fade">
		</div>
		<div id="users" class="tab-pane fade">
		</div>
		<div id="add_system_machine" class="tab-pane fade">
		</div>
		<div id="add_product_section" class="tab-pane fade">
		</div>
		<div id="add_product_items" class="tab-pane fade">
		</div>
		<div id="add_product_items_details" class="tab-pane fade">
		</div>
		<div id="add_advertising" class="tab-pane fade">
		</div>
		<div id="advertising" class="tab-pane fade">
		</div>
	</div>

</div>



</body>
</html>

<script>
	
			//add_system_machine
	function on_click_add_system_machine(){
		$.ajax({
		url:'add_system_machine.php',
		type:'POST',
		success:function(data){
						if(data != ''){
										$(".nav-sm li.active").removeClass("active");
										$('.tab-content').children().remove();
										$('.tab-content').append( "<div id='aja_content'></div>" );
										$('#aja_content').html(data);
										$(".nav-sm li").addClass("active");
						}else{
										$('.tab-content').load('href');
						}
				}
		});
		return false;
}

$(document).on('click','#add_system_machine',function(){
		on_click_add_system_machine();
		return false;
});
	//End add_system_machine
 
 			//add_product_section
	function on_click_add_product_section(){
		$.ajax({
		url:'add_item_section.php',
		type:'POST',
		success:function(data){
						if(data != ''){
										$(".nav-sm li.active").removeClass("active");
										$('.tab-content').children().remove();
										$('.tab-content').append( "<div id='aja_content'></div>" );
										$('#aja_content').html(data);
						}else{
										$('.tab-content').load('href');
						}
				}
		});
		return false;
}

$(document).on('click','#add_product_section',function(){
		on_click_add_product_section();
		return false;
});
	//End add_product_section
	
	
	//add_product_items
	function on_click_add_product_item(){
		$.ajax({
		url:'add_product_item.php',
		type:'POST',
		success:function(data){
						if(data != ''){
										$(".nav-sm li.active").removeClass("active");
										$('.tab-content').children().remove();
										$('.tab-content').append( "<div id='aja_content'></div>" );
										$('#aja_content').html(data);
						}else{
										$('.tab-content').load('href');
						}
				}
		});
		return false;
}

$(document).on('click','#add_product_items',function(){
		on_click_add_product_item();
		return false;
});
	//End add_product_items
 
 //add_product_items_detail
	function on_click_add_product_item_detail(){
		$.ajax({
		url:'add_product_item_details.php',
		type:'POST',
		success:function(data){
						if(data != ''){
										$(".nav-sm li.active").removeClass("active");
										$('.tab-content').children().remove();
										$('.tab-content').append( "<div id='aja_content'></div>" );
										$('#aja_content').html(data);
						}else{
										$('.tab-content').load('href');
						}
				}
		});
		return false;
}

$(document).on('click','#add_product_items_details',function(){
		on_click_add_product_item_detail();
		return false;
});
	//End add_product_items_detail
	
	//add_advertising
	
	
	
	
	
	//add_advertising
	function on_click_add_advertising(){
		$.ajax({
		url:'add_ad.php',
		type:'POST',
		success:function(data){
						if(data != ''){
										$(".nav-sm li.active").removeClass("active");
										$('.tab-content').children().remove();
										$('.tab-content').append( "<div id='aja_content'></div>" );
										$('#aja_content').html(data);
						}else{
										$('.tab-content').load('href');
						}
				}
		});
		return false;
}

$(document).on('click','#add_advertising',function(){
		on_click_add_advertising();
		return false;
});
	//End add_advertising
	
	//system_machine
	function on_click_system_machine(){
		$.ajax({
		url:'system_machine.php',
		type:'POST',
		success:function(data){
						if(data != ''){
										$(".nav-sm li.active").removeClass("active");
										$('.tab-content').children().remove();
										$('.tab-content').append( "<div id='aja_content'></div>" );
										$('#aja_content').html(data);
						}else{
										$('.tab-content').load('href');
						}
				}
		});
		return false;
}

$(document).on('click','#system_machine',function(){
		on_click_system_machine();
		return false;
});
	//End system_machine
	



// product section
function on_click_product_section(){
		$.ajax({
		url:'product_section.php',
		type:'POST',
		success:function(data){
				if(data != ''){
					$(".nav-sm li.active").removeClass("active");
					$('.tab-content').children().remove();
					$('.tab-content').append( "<div id='aja_content' class='col-lg-10'></div>" );
					$('#aja_content').html(data);
				}else{
					$('.tab-content').load('href');
				}
			}
		});
		return false;
}

$(document).on('click','#product_section',function(){
		on_click_product_section();
});
// End product section

// invoice
function on_click_invoice(){
		$.ajax({
		url:'invoice.php',
		type:'POST',
		success:function(data){
				if(data != ''){
					$(".nav-sm li.active").removeClass("active");
					$('.tab-content').children().remove();
					$('.tab-content').append( "<div id='aja_content' class='col-lg-10'></div>" );
					$('#aja_content').html(data);
				}else{
					$('.tab-content').load('href');
				}
			}
		});
		return false;
}

$(document).on('click','#invoice',function(){
		on_click_invoice();
});
// End invoice

// user
function on_click_user(){
		$.ajax({
		url:'user.php',
		type:'POST',
		success:function(data){
				if(data != ''){
					$(".nav-sm li.active").removeClass("active");
					$('.tab-content').children().remove();
					$('.tab-content').append( "<div id='aja_content' class='col-lg-10'></div>" );
					$('#aja_content').html(data);
				}else{
					$('.tab-content').load('href');
				}
			}
		});
		return false;
}

$(document).on('click','#users',function(){
		on_click_user();
});
// End user

// advertising
function on_click_advertising(){
		$.ajax({
		url:'advertising.php',
		type:'POST',
		success:function(data){
				if(data != ''){
					$(".nav-sm li.active").removeClass("active");
					$('.tab-content').children().remove();
					$('.tab-content').append( "<div id='aja_content' class='col-lg-10'></div>" );
					$('#aja_content').html(data);
				}else{
					$('.tab-content').load('href');
				}
			}
		});
		return false;
}

$(document).on('click','#advertising',function(){
		on_click_advertising();
});
// End advertising

$(document).ready(function() {
	on_click_system_machine();
	return false;
});
</script>

<!--
<script type="text/javascript">
	
	$(document).ready(function() {
		var dataTable = $('#example').dataTable({
					"pageLength":12
		});

		$("#searchBox").keyup(function() {
			dataTable.fnFilter(this.value);
		}); 		
	});
</script>
<script type="text/javascript">
	
$(document).ready(function() {

var x = $('.id_hidden').attr('id');
var y = 0 ;
				function isalert(){ // this function to show number of alert in bell
					//alert(x);
					$.ajax({
								url:'isAle.php',
								type:'POST',
								data:{x:x },
								success:function(data){
											if(data > 0){
														if(data != y){
																	y = data;
																	$('.fa-be').append('<style>.fa-be:after{ content:"'+data+'"; position: absolute; background: red; height:1.5rem; top:1rem; left:1.5rem;width:1.5rem;text-align: center; line-height: 1.25rem; font-size: 1rem; border-radius: 100%; color:white; border:1px solid red;}</style>');
														}
											}
								}// end success
						});// end ajax
					return false;
				}
		setInterval(function(){ isalert(); }, 1000);
		
		function menualert(){ // this function to show drop menu of alert in bell
					//alert(x);
					
					$.ajax({
								url:'bel_menu.php',
								type:'POST',
								data:{x:x },
								success:function(data){
											 //id="ale_men"
												//alert(data);
												$('#ale_men').html(data);
								}// end success
						});// end ajax
		} // end function menualert 
		$('.fa-be').click(function(){
					if (y != 0){
								$('#ale_men').removeClass('hidden');
								$('#ale_men').addClass('dropdown-menu');
								menualert();
					}
		});
		
		$(window).bind("resize", function () {
        if ($(this).width() > 767) {
												$('#asideNav').removeClass("col-lg-10-invoi");
            $('#asideNav').addClass("col-lg-10-inv");
        } 
    }).resize();
		//.trigger('resize');
		
				
	
	
});

</script>

-->