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
        <th style="text-align: -webkit-left;">Macine Name</th>
        <th style="text-align: -webkit-left;">Dist Name</th>
        <th style="text-align: -webkit-left;">Lat</th>
        <th style="text-align: -webkit-left;">Long</th>
        <th style="text-align: -webkit-left;">Edit</th>
        <th style="text-align: -webkit-left;">Delete</th>
    </tr>
</thead>

<?php
require_once('../incDB/systemMachineAPI.php');

$qry_sm = sm_get();
if( mysqli_num_rows($qry_sm) > 0 ){
  while($sm = mysqli_fetch_assoc($qry_sm)){
?>
  
    <tr class="">
    <td class="col-lg-2">
      <b><?php echo $sm['sm_name'] ;?></b>
    </td>
    <td  class="col-lg-2" style="text-align: -webkit-left;">
      <b><?php echo $sm['sm_dist'] ;?></b>
    </td>
    
    <td class="col-lg-2" style="text-align: -webkit-center;">
      <?php echo $sm['sm_lat'] ;?>
    </td>
    
    <td class="col-lg-2" style="text-align: -webkit-center;">
      <?php echo $sm['sm_long'] ;?>
    </td>
      
    <td class="text-center col-lg-1">
      <a href="#" id="<?php echo $sm['sm_id'] ;?>" class="sm-edit">
        <span class="fa fa-edit" style="color:blue; font-size:22px;  opacity: 0.7;"></span
      </a>
    </td>
    <td class="text-center col-lg-1">
      <a href="#" id="<?php echo $sm['sm_id'] ;?>" class="sm-trash">
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
  
  function after_delete_sm(){
    $.ajax({
         url:'system_machine.php',
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
 
 // This code for open invoice detail on click row
$(document).on('click','.parent',function(){
    var id_ord = $(this).attr("id");
    $.ajax({
        url:'row_ord.php',
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
// End invice Detail

	// start delete
	$(document).on('click','.sm-trash',function(){
		var id = $(this).attr("id");
		if(confirm("Are you sure you want delete this?")){
			//window.location.href == "main.php#del";
			$.ajax({
				url:'includeOP/delete_sm_op.php',
				type:'POST',
				data:'sm_id='+id,
				success:function(data){
					if(data.error){
						alert("Can't delete, please try again !!!");
					}else{
						alert("System Machine is delete successfully");
						after_delete_sm();
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
		$(document).on('click','.sm-edit',function(){
					var id = $(this).attr("id");
					if(confirm("Are you sure you want UPDATE this ?")){
								$.ajax({
										url:'edit_sm.php',
										type:'POST',
										data:'sm_id='+id,
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