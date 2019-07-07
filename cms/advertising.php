<?php
require_once('../incDB/session.php');
if($_SESSION['userinfo'] == false) header ('Location:../index.php');

require_once('../incDB/db.php');

$statment_adv = mysqli_query($mp_handle, "SELECT * FROM `advertising`");
    if(!$statment_adv) die('qyr');
            
    $total_rows = mysqli_num_rows($statment_adv);
            
if($total_rows > 0 ){
	echo '<div class = " col-lg-11">';
	while($row = mysqli_fetch_assoc($statment_adv)){
		$advertising_id = $row["ad_id"];
		echo '
			<div class="panel-group col-lg-6">
				<div class="panel panel-danger">
				  <div class="panel-body"><img src="imgAD/'.$row["ad_img_name"].'"  width="100%" height="200"/></div>
				  <div class="panel-footer">
					<a href="#" id="'.$advertising_id.'" class="deleteAdv pull-left">
						<span class="fa fa-trash" style="color:red; font-size:22px;"></span>
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
// move to TRASH folder
$(document).on('click','.deleteAdv',function(){
	var id = $(this).attr("id");
	if(confirm("Are you sure you want to delete?")){
		$.ajax({
			url:'delete_advertising.php',
			type:'POST',
			data:'idAD='+id,
			success:function(data){
				if(data.error){
					alert('Not deleted Please try again !!');
				}else{
					$.ajax({
						url:'advertising.php',
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

</script>