<?php
require_once('../incDB/session.php');
if($_SESSION['userinfo'] == false) header ('Location:../index.php');

?>

<div>
	<button type="button" class="btn btn-success act">SHOW ACTIVE SECTION</button>
	<button type="button" class="btn btn-danger unAct">SHOW ALL SECTION</button>
</div>
<br/>

<div class="actSection col-lg-12"></div>

<script>
function on_click_act(){
		$.ajax({
		url:'product_section_active.php',
		type:'POST',
		success:function(data){
				if(data != ''){
					$('.actSection').children().remove();
					$('.actSection').append( "<div id='section_content'></div>" );
					$('#section_content').html(data);
				}else{
					$('.actSection').load('href');
				}
			}
		});
		return false;
}

$(document).on('click','.act',function(){
		on_click_act();
});

function on_click_unAct(){
		$.ajax({
		url:'product_section_all.php',
		type:'POST',
		success:function(data){
				if(data != ''){
					$('.actSection').children().remove();
					$('.actSection').append( "<div id='section_content'></div>" );
					$('#section_content').html(data);
				}else{
					$('.actSection').load('href');
				}
			}
		});
		return false;
}

$(document).on('click','.unAct',function(){
		on_click_unAct();
});

$(document).ready(function() {
	on_click_act();
	return false;
});
</script>