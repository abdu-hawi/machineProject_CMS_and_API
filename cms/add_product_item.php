<?php
require_once('../incDB/session.php');
if($_SESSION['userinfo'] == false) header ('Location:../index.php');

require_once('../incDB/itemSectionAPI.php');

$row = section_get();
$pJson = json_decode($row, true);
if(count($pJson) === 0){
	die('<div class="alert alert-danger col-lg-10"><b>Please add section item before add any items</b></div>');
}
?>

<h2>Add new item</h2>
<hr><br/>
<form id="uploadimage" class="form-horizontal col-lg-10  col-md-12 col-sm-12 col-xs-12" action="" method="post" enctype="multipart/form-data">
	<div id="message">
    </div>
    <div id="selectImage" class="form-group">
        <div class="panel-body">
			<select class="form-control" id="sectionName" name="sectionName">
			  <option value="dd">Select Section</option>
			  <?php foreach($pJson as $po){ ?>
				<option value="<?php echo $po['ps_id'] ?>"><?php echo $po['ps_name'] ?></option>
			  <?php } ?>
			</select>
			<input class="form-control" type="text" placeholder="Item name" id="itemName" name="itemName"  required />
			<input class="form-control" type="text" placeholder="Discription" id="itemDesc" name="itemDesc"  required />
			<input class="form-control" type="number" step="0.01" min="0" placeholder="Price" id="itemPrice" name="itemPrice"  required />
            <input type="file" class="form-control" placeholder="Select Your Image" name="file" id="file" required />
            <div id="image_preview">
            	<img id="previewing" src="noimage.gif" />
            </div>
        </div>
    </div>
    <div class="form-group">        
      <div class="col-lg-12">
      	<input type="submit" value="Add Item" class="submit btn btn-success " />
      </div>
    </div>
    
</form>

<script>
$(document).ready(function (e) {
	$('#image_preview').hide();
	$("#uploadimage").on('submit',(function(e) {
		e.preventDefault();
		$('#image_preview').show();
		$.ajax({
			url: "includeOP/add_item_op.php", // Url to which the request is send
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
					document.getElementById("itemName").value = "";
					document.getElementById("itemDesc").value = "";
					document.getElementById("file").value = "";
					document.getElementById("itemPrice").value = "";
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
	
	// func to upload to server
	function upImg(){
		
	}
	
	// Function to preview image after validation
	$(function() {
		$("#file").change(function() {
			//// Firest work: when img choise
			$("#message").empty(); // To remove the previous error message
			var file = this.files[0];
			var imagefile = file.type;
			var match= ["image/jpeg","image/png","image/jpg"];
			
			//Second work: to check if image or not
			
			if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
			{
				//$('#image_preview').show();
				//$('#previewing').attr('src','noimage.png');
				$("#message").html("<h3 id='error' style=\"color:#ff0000;\">Please select s image file</h3>"+"<h4>Note:</h4>"+"<span id='error_message'>Only jpeg, jpg and png Images type allowed</span>");
				return false;
			}
			else
			{
				var reader = new FileReader();
				reader.onload = imageIsLoaded;
				reader.readAsDataURL(this.files[0]);
			}
		});
	});
	function imageIsLoaded(e) {
		// Third work: to load img in page
		$("#file").css("color","green");
		$('#image_preview').css("display", "block");
		$('#previewing').attr('src', e.target.result);
		$('#previewing').attr('width', '250px');
		$('#previewing').attr('height', '230px');
	}
});

</script>
