<?php
require_once('../incDB/session.php');
if($_SESSION['userinfo'] == false) header ('Location:../index.php');
?>
<div class="col-lg-11">
  
  <style>
  .back-inv{
		font-weight:bold;
	}
</style>

<table id="sm-table" class="table table-hover col-lg-10">
<thead class=""><!--<thead class="hidden">-->
    <tr>
        <th style="text-align: -webkit-center;">User Name</th>
        <th style="text-align: -webkit-center;">User Mobile</th>
        <th style="text-align: -webkit-center;">User Email</th>
        <th style="text-align: -webkit-center;">User Type</th>
        <th style="text-align: -webkit-left;">Edit</th>
        <th style="text-align: -webkit-left;">Delete</th>
    </tr>
</thead>

<?php
require_once('../incDB/usersAPI.php');

$qry_user = user_get();
if( mysqli_num_rows($qry_user) > 0 ){
  while($u = mysqli_fetch_assoc($qry_user)){
?>
  
    <tr class="">
    <td class="col-lg-2">
      <b><?php echo $u['u_name'] ;?></b>
    </td>
    <td  class="col-lg-2" style="text-align: -webkit-center;">
      <b><?php echo "0".$u['u_mobile'] ;?></b>
    </td>
    
    <td class="col-lg-2" style="text-align: -webkit-center;">
      <?php echo $u['u_email'] ;?>
    </td>
    
    <td class="col-lg-2" style="text-align: -webkit-center;">
      <?php 
		if($u['u_type'] == 1)
			echo "Admin" ;
		else
			echo "Costumer";
	  ?>
    </td>
      
    <td class="text-center col-lg-1">
	<?php if($u['u_type'] == 1)
		echo '
      <a href="#" id="'.$u['u_id'].'" class="u-edit">
        <span class="fa fa-edit" style="color:blue; font-size:22px;  opacity: 0.7;"></span
      </a>
	  ';
	  ?>
    </td>
    <td class="text-center col-lg-1">
      <a href="#" id="<?php echo $u['u_id'] ;?>" class="u-trash">
        <span class="fa fa-trash" style="color:red; font-size:22px;  opacity: 0.7;"></span>
      </a>
    </td>
  </tr>                                              
    <?php 
  } // end while loop
} // end if mysqli_num_rows($qry_sm)                          
?>
</table>
	
<script>


  var table = $('#sm-table').dataTable({
					"pageLength":12
		});
		
		$('#searchBox').keyup(function() {
		   table.fnFilter(this.value);
		});
  
  function after_delete_user(){
    $.ajax({
         url:'user.php',
         type:'POST',
         success:function(data){
             if(data != ''){
                 //$(".nav-in li.active").removeClass("active");
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
 

	// start delete
	$(document).on('click','.u-trash',function(){
		var id = $(this).attr("id");
		if(confirm("Are you sure you want delete this?")){
			$.ajax({
				url:'includeOP/delete_user_op.php',
				type:'POST',
				data:'user_id='+id,
				success:function(data){
					if(data.error){
						alert("Can't delete, please try again !!!");
					}else{
						alert("User is delete successfully");
						after_delete_user();
					}
				}
			});
		return false;
		}else{
			return false;
		}
	});
    // End delete
    
    	// start edit
		$(document).on('click','.u-edit',function(){
					var id = $(this).attr("id");
					if(confirm("Are you sure you want UPDATE this ?")){
								$.ajax({
										url:'edit_user.php',
										type:'POST',
										data:'user_id='+id,
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
					}else{
						return false;
					}
		});
    // End edit
	
</script>

  
</div>