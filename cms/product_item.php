<?php
require_once('../incDB/session.php');
if($_SESSION['userinfo'] == false) header ('Location:../index.php');
?>
<style>
  .back-inv{
		font-weight:bold;
	}
</style>
<div class="col-lg-11">

<table id="product-item-table" class="table table-hover">
<!-- <thead class="hidden"> -->
<thead>
    <tr>
        <th>img</th>
        <th style="text-align:-webkit-left;">Name</th>
        <th style="text-align:-webkit-left;">Description</th>
        <th style="text-align:-webkit-center;">Price</th>
        <th style="text-align:-webkit-left;">Section Name</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
</thead>
  
<?php
//require_once('../include_db/session.php');
require_once('../incDB/db.php');
//if($_SESSION['userinfo'] != false)
//$user_id = $_SESSION['userinfo']->user_id;
//else $user_id = $_SESSION['cominfo']->com_id;
//GLOBAL $tf_handle;
$statment_product_item = mysqli_query($mp_handle, "SELECT * FROM `product` WHERE `Section` = '".$_POST['id']."' ORDER BY ID DESC");
    if(!$statment_product_item) die('qyr');
            //$statment_inbox->execute();
            
    $total_rows = mysqli_num_rows($statment_product_item);
            
if($total_rows > 0 ){
	while($row = mysqli_fetch_assoc($statment_product_item)){
		$order_id = $row["ID"];
		echo '<tr class="">';
		echo '
			<td class="col-lg-1">
					<a data-toggle="tab" href="#ord" id="'.$order_id.'"
					   class="parent" style="display: block;width: 100%; text-decoration:none; color:#000;">
							<img class="img-circle img-inv" src="upload/'.$row["IMG"].'" alt="'.$row["Name"].'" width="50" hieght="35"/>
					</a>
			</td>' ?>
			
															
			<?php echo '
			<td class="col-lg-2">
				<a data-toggle="tab" href="#ord" id="'.$order_id.'" class="parent" style="display: block;width: 100%; text-decoration:none; color:#000;">
				'.$row["Name"].'
				</a>
			</td>
			<td  class="col-lg-3" style="text-align: -webkit-left;">
			  <a data-toggle="tab" href="#ord" id="'.$order_id.'" class="parent" style="display: block;width: 100%; text-decoration:none; color:#000;">
				'.$row["Desc"].'
			  </a>
			</td>
			<td class="col-lg-2" style="text-align: -webkit-center;">
			  <a data-toggle="tab" href="#ord" id="'.$order_id.'" class="parent" style="display: block;width: 100%; text-decoration:none; color:#000;">
				 <b>'.$row["price"].'</b> SR
			  </a>
			</td>
			<td  class="col-lg-2" style="text-align: -webkit-left;">
			  <a data-toggle="tab" href="#ord" id="'.$order_id.'" class="parent" style="display: block;width: 100%; text-decoration:none; color:#000;">
				'.$row["Section"].'
			  </a>
			</td>
			<td class="text-center">
			  <a href="#" id="'.$order_id.'" class="edit">
				<span class="fa fa-edit" style="color:blue; font-size:22px;"></span>
			  </a>
			</td>
			<td class="text-center">
			  <a href="#" id="'.$order_id.'" class="delete" data="'.$row["IMG"].'">
				<span class="fa fa-trash" style="color:red; font-size:22px;"></span>
			  </a>
			</td>
		  </tr>
		  ';
	}
}
                            
?>
</table>

</div>
	
<script>

  var table = $('#product-item-table').dataTable({
					"pageLength":12
		});
		
		$('#searchBox').keyup(function() {
		   table.fnFilter(this.value);
		});

  
    // This code for open product detail on click row
$(document).on('click','.parent',function(){
    var id_ord = $(this).attr("id");
    $.ajax({
        url:'row_product.php',
        type:'POST',
        data:'id='+id_ord,
        success:function(data){
            if(data != ''){
                $(".nav-in li.active").removeClass("active");
                $('.tab-content').children().remove();
                 $('.tab-content').append( "<div id='aja_content'></div>" );
                 $('#aja_content').html(data);
            }else{
                $('.tab-content').load('href');
            }
        }
    });
    
    return false;
});
// End open product Detail

// move to TRASH folder
$(document).on('click','.delete',function(){
	var img = $(this).attr("data");
	var id = $(this).attr("id");
	if(confirm("You can not restore if deleted, are you sure you want to delete?")){
		$.ajax({
			url:'delete_product_item.php',
			type:'POST',
			data:'id='+id,
			success:function(data){
				if(data.error){
					alert('Not deleted Please try again !!');
				}else{
					$.ajax({
						url:'product_item.php',
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
			}
		});
	}else{
		return false;
	}
});
// End Move to trash folder
    
// edit
$(document).on('click','.edit',function(){
	var id = $(this).attr("id");
	$.ajax({
		url:'edit_product_item.php',
		type:'POST',
		data:'id='+id,
		success:function(data){
			if(data.error){
				alert('Not deleted Please try again !!');
			}else{
				$(".nav-in li.active").removeClass("active");
                $('.tab-content').children().remove();
                $('.tab-content').append( "<div id='aja_content'></div>" );
                $('#aja_content').html(data);
				
			}
		}
	});
	return false;
});
// End Edit
	
</script>
