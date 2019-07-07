<?php
require_once('../incDB/session.php');
if($_SESSION['userinfo'] == false) header ('Location:../index.php');

$response = array();
if($_SERVER['REQUEST_METHOD'] != 'POST'){
	$response['error'] = true;
    $response['msg'] = 'Cannot connect to server';
	die( json_encode($response) );
}
if(!isset($_POST['user_id'])){
	$response['error'] = true;
    $response['msg'] = 'Cannot connect';
	die( json_encode($response) );
}


//require_once('../incDB/db.php');
require_once('../incDB/usersAPI.php');

$userGet = user_get_by_id($_POST['user_id']);
$uJson = json_decode($userGet, true);
foreach($uJson as $u){
?>

<h2>Edit: <b><?php echo $u['name']; ?> </b></h2>
<hr><br/>
<form id="editUser" class="form-horizontal col-lg-10  col-md-12 col-sm-12 col-xs-12" action="" method="post" >
	<div id="message">
    </div>
    <div id="selectImage" class="form-group">
        <div class="panel-body">
			<select class="form-control" id="typeName" name="typeName">
			  <option value="dd">Select Type</option>
			  <?php 
						if( $u['type'] == 1){
							echo '<option value="'.$u['type'].'" selected>Admin</option>';
							echo '<option value="'.$u['type'].'">Customer</option>';
						}else{
							echo '<option value="'.$u['type'].'">Admin</option>';
							echo '<option value="'.$u['type'].'" selected>Customer</option>';
						}
					 
				?>
			</select>
			<input type="hidden" value="<?php echo $_POST['user_id'] ?>" name="userID"  required />
			<input class="form-control" type="text" placeholder="User name" value="<?php echo $u['name'] ?>" id="userName" name="userName"  required />
			<input class="form-control" type="email" placeholder="User email" value="<?php echo $u['email'] ?>" id="userEmail" name="userEmail"  required />
			<input class="form-control" type="phone" placeholder="Mobile" value="<?php echo "0".$u['mobile'] ?>" id="userMobile" name="userMobile"  required />
        </div>
    </div>
    <div class="form-group">        
      <div class="col-lg-12">
      	<input type="submit" value="Updating User" class="submit btn btn-info " />
      </div>
    </div>
  
</form>
<?php } // end foreach for pJson ?>
<script>
$(document).ready(function (e) {
	//$('#image_preview').hide();
	$("#editUser").on('submit',(function(e) {
		e.preventDefault();
		$.ajax({
			url: "includeOP/edit_user_op.php", // Url to which the request is send
			type: "POST",             // Type of request to be send, called as method
			data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
			contentType: false,       // The content type used when sending data to the server.
			cache: false,             // To unable request pages to be cached
			processData:false,        // To send DOMDocument or non processed data file it is set to false
			success: function(data)   // A function to be called if request succeeds okUpdate
			{
				data = $.parseJSON( data );
				if(data.msg == 'ok'){
					$('#message').html('<div class="alert alert-success"><b>User is Adding</b></div>');
					//$('#itemName').value = "";
					document.getElementById("userName").value = "";
					document.getElementById("userEmail").value = "";
					document.getElementById("userMobile").value = "";
					document.getElementById("typeName").value = "";
				}else if(data.msg == 'okUpdate'){
					$('#message').html('<div class="alert alert-success"><b>User is Updating</b></div>');
				}else{
					$('#message').html('<div class="alert alert-danger"><b>'+data.msg+'</b></div>');
				}
			}
		});
	}));

});

</script>
