<?php
require_once('../incDB/session.php');
if($_SESSION['userinfo'] == false) header ('Location:../index.php');


require_once('../incDB/systemMachineAPI.php');
$row_sm = sm_get();
if( mysqli_num_rows($row_sm) == 0 ){
	die('<div class="alert alert-danger col-lg-10"><b>Please add system machine first</b></div>');
}
require_once('../incDB/productItemAPI.php');
$row_pro = product_get();
if( mysqli_num_rows($row_pro) == 0 ){
	die('<div class="alert alert-danger col-lg-10"><b>Please add product item first</b></div>');
}
?>

<h2>Add item detail</h2>
<hr><br/>
<form id="itemDetails" class="form-horizontal col-lg-10  col-md-12 col-sm-12 col-xs-12" action="" method="post">
	<div id="message" >
    </div>
    <div class="form-group">
        <div class="panel-body">
			<select class="form-control" id="machineName" name="machineName">
			  <option value="dd">Select System Machine</option>
			  <?php
				while($sm = mysqli_fetch_assoc($row_sm)){
			  ?>
				<option value="<?php echo $sm['sm_id'] ?>"><?php echo $sm['sm_name'] ?></option>
				<?php
				  }
				?>
			</select>
			<select class="form-control" id="itemName" name="itemName">
			  <option value="dd">Select Product Item</option>
			  <?php
				while($pro = mysqli_fetch_assoc($row_pro)){
			  ?>
				<option value="<?php echo $pro['pi_id'] ?>"><?php echo $pro['pi_name'] ?></option>
				<?php
				  }
				?>
			</select>
			<input class="form-control" type="text" placeholder="Item quantity" id="itemQTY" name="itemQTY"  required />
			<input class="form-control" type="date" placeholder="Production Date" id="prodDate" name="prodDate"  required />
			<input class="form-control" type="date" placeholder="Expiry date" id="expDate" name="expDate"  required />
            <div id="image_preview">
            	<img id="previewing" src="noimage.gif" />
            </div>
        </div>
    </div>
    <div class="form-group">        
      <div class="col-lg-12">
      	<input type="submit" value="Add Item Details" class="submit btn btn-success " />
      </div>
    </div>
    
</form>

<script>
$(document).ready(function (e) {
	$('#image_preview').hide();
	$("#itemDetails").on('submit',(function(e) {
		e.preventDefault();
		$('#image_preview').show();
		$.ajax({
			url: "includeOP/add_item_detail_op.php", // Url to which the request is send
			type: "POST",             // Type of request to be send, called as method
			data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
			contentType: false,       // The content type used when sending data to the server.
			cache: false,             // To unable request pages to be cached
			processData:false,        // To send DOMDocument or non processed data file it is set to false
			success: function(data)   // A function to be called if request succeeds okUpdate
			{
				data = $.parseJSON( data );
				if(data.msg == 'ok'){
					$('#message').html('<div class="alert alert-success"><b>Item is Adding</b></div>');
					//$('#itemName').value = "";
					document.getElementById("itemQTY").value = "";
					document.getElementById("prodDate").value = "";
					document.getElementById("expDate").value = "";
					$('#image_preview').hide();
				}else if(data.msg == 'okUpdate'){
					$('#message').html('<div class="alert alert-success"><b>Item is Updating</b></div>');
					$('#image_preview').hide();
				}else{
					$('#message').html('<div class="alert alert-danger"><b>'+data.msg+'</b></div>');
					$('#image_preview').hide();
				}
			}
		});
	}));

});

</script>
