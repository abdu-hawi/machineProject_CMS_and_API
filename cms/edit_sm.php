<?php
require_once('../incDB/session.php');
if($_SESSION['userinfo'] == false) header ('Location:../index.php');

if($_SERVER['REQUEST_METHOD'] != 'POST'){
	die('Request failed, please try again');
}
if(!isset($_POST['sm_id']) ){
	die('Request failed, please try again');
}
		
require_once('../incDB/systemMachineAPI.php');
$qry_sm = sm_get_by_id($_POST['sm_id']);
if( mysqli_num_rows($qry_sm) > 0 ){
  while($sm = mysqli_fetch_assoc($qry_sm)){
?>
<div>
	
	
	<div class="col-lg-10  col-md-12 col-sm-12 col-xs-12 con-mar-top">
		
		<div id="show"></div>
		<br/>
    	<form method="post" id="update_system_machine" action="" >
    	<div>
        	<div class="panel-heading">
            	<h2>Update System Machine</h2>
            </div>
					<input class="hidden" type="text" id="smID"
					   value="<?php echo $sm['sm_id'] ?>" name="smID" required />
            <div class="panel-body">
            	<input class="form-control" type="text" id="smName" placeholder="System machine name"
					   value="<?php echo $sm['sm_name'] ?>" name="smName" required />
                <input class="form-control" type="text" id="distName" placeholder="District name"
					   value="<?php echo $sm['sm_dist'] ?>" name="distName" required />
                <input class="form-control" type="number" id="lat" step="0.000001" min="-90.0" max="90.0"
					   value="<?php echo $sm['sm_lat'] ?>" placeholder="Write SM latitude" name="lat" required />
                <input class="form-control" type="number" id="long" step="0.000001" min="-180.0" max="180.0"
					   value="<?php echo $sm['sm_long'] ?>" placeholder="Write SM longitude" name="long" required />
                <br/><br/>
                <button class="btn btn-warning btn-block" id="update_system" type="submit" name="submit">Process Update system</button>
            </div><!-- End panel body -->
        </div><!-- End panel -->
        </form>
    </div>
</div>

<script>
	$("#update_system_machine").on('submit',(function(e) {
		e.preventDefault();
		$.ajax({
			url: "includeOP/edit_sm_op.php", // Url to which the request is send
			type: "POST",             // Type of request to be send, called as method
			data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
			contentType: false,       // The content type used when sending data to the server.
			cache: false,             // To unable request pages to be cached
			processData:false,        // To send DOMDocument or non processed data file it is set to false
			success: function(data)   // A function to be called if request succeeds okUpdate
			{
				data = $.parseJSON( data );
				if(data.msg == 'ok'){
					$('#show').html('<div class="alert alert-success"><b>System machine update successfully</b></div>');
				}else{
					$('#show').html('<div class="alert alert-danger"><b>'+data.msg+'</b></div>');
				}
			}
		});
	}));
</script>

<?php
  } // end while
}// end if
?>