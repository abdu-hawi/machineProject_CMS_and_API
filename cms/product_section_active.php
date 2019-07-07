<?php
require_once('../incDB/db.php');

$statment_product_section = mysqli_query($mp_handle, "SELECT * FROM `product_section` WHERE `isAvilable` = 0");
    if(!$statment_product_section) die('qyr');
            //$statment_inbox->execute();
            
    $total_rows = mysqli_num_rows($statment_product_section);
            
if($total_rows > 0 ){
	echo '<br><div>';
	while($row = mysqli_fetch_assoc($statment_product_section)){
		$sec_id = $row["ps_id"];
		echo'
			<div class="panel-group col-lg-4">
				<div class="panel panel-success">
				  <div class="panel-heading"><b>'.$row["ps_name"].'</b></div>
				<a href="#" id="'.$row["ps_name"].'" class="sec_parent">
				  <div class="panel-body"><img src="upload/'.$row["ps_image"].'"  width="100%" height="200"/></div>
				</a>
				  <div class="panel-footer">
					<a href="#" id="'.$sec_id.'" class="deleteSec pull-right">
						<span style="color:red; font-size:16px;">Make it inactive</span>
					  </a>
					  <a href="#" id="'.$sec_id.'" class="editSec pull-left">
						<span style="color:blue; font-size:16px;">Edit</span>
					  </a>
					  <span class="clearfix"></span>
				  </div>
				</div>
			</div>
		';

	}
	echo '</div>';
}
?>

<script>

//add_product_items
function on_click_sec_parent(id){
	$.ajax({
		url:'product_item.php',
		type:'POST',
		data:'id='+id,
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

$(document).on('click','.sec_parent',function(){
	var id = $(this).attr("id");
		on_click_sec_parent(id);
		return false;
});

// move to TRASH folder
$(document).on('click','.deleteSec',function(){
	var id = $(this).attr("id");
	if(confirm("Are you sure you want to inactive?")){
		$.ajax({
			url:'delete_product_section.php',
			type:'POST',
			data:'id='+id,
			success:function(data){
				if(data.error){
					alert('Not deleted Please try again !!');
				}else{
					$.ajax({
						url:'product_section.php',
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
$(document).on('click','.editSec',function(){
	var id = $(this).attr("id");
	$.ajax({
		url:'edit_section.php',
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