<?php
require_once('../incDB/session.php');
if($_SESSION['userinfo'] == false) header ('Location:../index.php');

if(!isset($_POST['id'])){
	die("you dont have access");
}
?>

<style>
  .back-inv{
		font-weight:bold;
	}
</style>
<div class="col-lg-11">

<table id="product-item-detail-table" class="table table-hover">
<!-- <thead class="hidden"> -->
<thead>
    <tr>
        <th style="text-align:-webkit-left;">Name</th>
        <th style="text-align:-webkit-left;">Quantity</th>
        <th style="text-align:-webkit-left;">Production Date</th>
        <th style="text-align:-webkit-left;">Expire Date</th>
        <th style="text-align:-webkit-left;">System Name</th>
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
$statment_product_item = mysqli_query($mp_handle, "SELECT * FROM `prod_item_detail` WHERE `pID` = ".$_POST['id']);
    if(!$statment_product_item) die('qyr');
            //$statment_inbox->execute();
            
    $total_rows = mysqli_num_rows($statment_product_item);
            
if($total_rows > 0 ){
	while($row = mysqli_fetch_assoc($statment_product_item)){
		$order_id = $row["itemID"];
		echo '<tr class="">';
		echo '
			<td class="col-lg-2">
				<a data-toggle="tab" href="#ord" id="'.$order_id.'" class="parent" style="display: block;width: 100%; text-decoration:none; color:#000;">
				'.$row["pName"].'
				</a>
			</td>
			<td  class="col-lg-1" style="text-align: -webkit-left;">
			  <a data-toggle="tab" href="#ord" id="'.$order_id.'" class="parent" style="display: block;width: 100%; text-decoration:none; color:#000;">
				'.$row["qty"].'
			  </a>
			</td>
			<td class="col-lg-2" style="text-align: -webkit-left;">
			  <a data-toggle="tab" href="#ord" id="'.$order_id.'" class="parent" style="display: block;width: 100%; text-decoration:none; color:#000;">
				 '.$row["prodDate"].'
			  </a>
			</td>
			<td  class="col-lg-2" style="text-align: -webkit-left;">
			  <a data-toggle="tab" href="#ord" id="'.$order_id.'" class="parent" style="display: block;width: 100%; text-decoration:none; color:#000;">
				'.$row["expDate"].'
			  </a>
			</td>
			<td  class="col-lg-2" style="text-align: -webkit-left;">
			  <a data-toggle="tab" href="#ord" id="'.$order_id.'" class="parent" style="display: block;width: 100%; text-decoration:none; color:#000;">
				'.$row["system"].'
			  </a>
			</td>
			<td class="text-center">
			  <a href="#" id="'.$order_id.'" class="edit">
				<span class="fa fa-edit" style="color:blue; font-size:22px;"></span>
			  </a>
			</td>
			<td class="text-center">
			  <a href="#" id="'.$order_id.'" class="delete">
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

  var table = $('#product-item-detail-table').dataTable({
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
		$(document).on('click','.inTrashFav',function(){
					var id = $(this).attr("id");
					if(confirm("هل توافق على حذف هذه الفاتورة؟")){
								$.ajax({
										url:'inTrash.php',
										type:'POST',
										data:'id='+id,
										success:function(data){
												if(data != 'ok'){
													alert('لم يتم حذف الفاتورة !! نرجوا اعادة المحاولة');
												}else{
                          on_click_fav();
												}
										}
								});
					}else{
						return false;
					}
		});
    // End Move to trash folder
    
    
	
</script>
