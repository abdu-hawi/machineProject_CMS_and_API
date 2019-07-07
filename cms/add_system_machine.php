<?php
require_once('../incDB/session.php');
if($_SESSION['userinfo'] == false) header ('Location:../index.php');
?>
<div>
	
	
	<div class="col-lg-10  col-md-12 col-sm-12 col-xs-12 con-mar-top">
		
		<div id="show"></div>
		<br/>
    	<form method="post" id="add_new_system_machine" action="" >
    	<div>
        	<div class="panel-heading">
            	<h2>Add new System Machine</h2>
            </div>
            <div class="panel-body">
            	<input class="form-control" type="text" id="smName" placeholder="System machine name" name="smName" required />
                <input class="form-control" type="text" id="distName" placeholder="District name" name="distName" required />
                <input class="form-control" type="number" id="lat" step="0.000001" min="-90.0" max="90.0" placeholder="Write SM latitude" name="lat" required />
                <input class="form-control" type="number" id="long" step="0.000001" min="-180.0" max="180.0" placeholder="Write SM longitude" name="long" required />
                <br/><br/>
                <button class="btn btn-primary btn-block" id="add_system" type="submit" name="submit">Process new system</button>
            </div><!-- End panel body -->
        </div><!-- End panel -->
        </form>
    </div>
</div>

<script>
	$("#add_new_system_machine").on('submit',(function(e) {
		e.preventDefault();
		$.ajax({
			url: "includeOP/add_sm_op.php", // Url to which the request is send
			type: "POST",             // Type of request to be send, called as method
			data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
			contentType: false,       // The content type used when sending data to the server.
			cache: false,             // To unable request pages to be cached
			processData:false,        // To send DOMDocument or non processed data file it is set to false
			success: function(data)   // A function to be called if request succeeds okUpdate
			{
				data = $.parseJSON( data );
				if(data.msg == 'ok'){
					$('#show').html('<div class="alert alert-success"><b>New system machine adding successfully</b></div>');
					//$('#itemName').value = "";
					document.getElementById("smName").value = "";
					document.getElementById("distName").value = "";
					document.getElementById("lat").value = "";
					document.getElementById("long").value = "";
				}else{
					$('#show').html('<div class="alert alert-danger"><b>'+data.msg+'</b></div>');
				}
			}
		});
	}));
</script>