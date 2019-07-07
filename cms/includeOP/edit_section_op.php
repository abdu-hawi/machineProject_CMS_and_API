<?php
require_once('../../incDB/session.php');
if($_SESSION['userinfo'] == false) header ('Location:../../index.php');

$response = array();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	if(isset($_FILES["file"]["type"]) && isset($_POST['sectionID']) && isset($_POST['sectionName']) &&
			isset($_POST['sectionIMG']) ){

		$validextensions = array("jpeg", "jpg", "png");
		$temporary = explode(".", $_FILES["file"]["name"]);
		$file_extension = end($temporary);
		
		if (( ($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")
				) && ($_FILES["file"]["size"] < 100000)//Approx. 100kb files can be uploaded.
				&& in_array($file_extension, $validextensions)) {
			if ($_FILES["file"]["error"] > 0) {
				$response['error'] = true;
				$response['msg'] = "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
				die(json_encode($response));
			} else { // end if of file error
				require_once('../../incDB/db.php');
				/*
				function section_update($id,$name,$img)
				{
					global $mp_handle;
					
					if ( empty($id) || empty($name) || empty($img) )
						return false;
					
					$n_id    = @mysqli_real_escape_string($mp_handle , strip_tags(trim($_POST['sectionID'])));
					$n_name    = @mysqli_real_escape_string($mp_handle , strip_tags(trim($_POST['sectionName'])));
					$n_img   = @mysqli_real_escape_string($mp_handle,strip_tags(trim($i_img_name)));
					
					$query = "UPDATE `product_section` SET `ps_name`= '$n_name' ,`ps_image`= '$n_img'  WHERE `ps_id`= ".$n_id;
					$qresult = @mysqli_query($mp_handle,$query);
					
					if(!$qresult)
						return false;
						
					return true;
				}
				*/
				if (file_exists("../upload/" . $_FILES["file"]["name"])) {
					
					$i_img_name = $_FILES["file"]["name"] ;
					
					/*
                    // insert to db
                    $n_sec = trim($_POST['sectionName']);
                    $n_img = trim($i_img_name);
					$n_id = trim($_POST['sectionID']);
                    
                    $result = section_update($n_id,$n_name,$n_img);
                    */
					$n_id    = @mysqli_real_escape_string($mp_handle , strip_tags(trim($_POST['sectionID'])));
					$n_name    = @mysqli_real_escape_string($mp_handle , strip_tags(trim($_POST['sectionName'])));
					$n_img   = @mysqli_real_escape_string($mp_handle,strip_tags(trim($i_img_name)));
					
					$query = "UPDATE `product_section` SET `ps_name`= '$n_name' ,`ps_image`= '$n_img' ,`isAvilable`= 0  WHERE `ps_id`= ".$n_id;
					$qresult = @mysqli_query($mp_handle,$query);
					
                    machine_db_close();
                    
                    if($qresult){
                        $response['error'] = false;
                        $response['msg'] = 'okUpdate';
                    }
                    else{
                        $response['error'] = true;
                        $response['msg'] = $_POST['itemName'] . " <span id='invalid'><b>can't updateing section, please try again.</b></span> ";
                        die(json_encode($response));
                    }
				}else{
                    // check for item name in db
                    
					unlink("../upload/".$_POST['sectionIMG']); // delete the prev img from server
					$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
					$targetPath = "../upload/".$_FILES['file']['name']; // Target path where file is to be stored
					move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
					
					$i_img_name = $_FILES["file"]["name"] ;
					
                    // insert to db
					/*
                    $n_sec = trim($_POST['sectionName']);
                    $n_img = trim($i_img_name);
					$n_id = trim($_POST['sectionID']);
                    
                    $result = section_update($n_id,$n_name,$n_img);
                    */
					
					$n_id    = @mysqli_real_escape_string($mp_handle , strip_tags(trim($_POST['sectionID'])));
					$n_name    = @mysqli_real_escape_string($mp_handle , strip_tags(trim($_POST['sectionName'])));
					$n_img   = @mysqli_real_escape_string($mp_handle,strip_tags(trim($i_img_name)));
					
					$query = "UPDATE `product_section` SET `ps_name`= '$n_name' ,`ps_image`= '$n_img' ,`isAvilable`= 0  WHERE `ps_id`= ".$n_id;
					$qresult = @mysqli_query($mp_handle,$query);
					
                    machine_db_close();
                    
                    if($qresult){
                        $response['error'] = false;
                        $response['msg'] = 'okUpdate';
                    }
                    else{
                        $response['error'] = true;
                        $response['msg'] = $_POST['itemName'] . " <span id='invalid'><b>can't updateing section, please try again.</b></span> ";
                        die(json_encode($response));
                    }
					
                    machine_db_close();
                    
                    if($result){
                        $response['error'] = false;
                        $response['msg'] = 'okUpdate';
                    }
                    else{
                        $response['error'] = true;
                        $response['msg'] = $_POST['itemName'] . " <span id='invalid'><b>can't Update section, please try again.</b></span> ";
                        die(json_encode($response));
                    }
                    // end insert to db
				} // end else of file exists
			} // end else of file error
		}else{ // end if of type & img size
			$response['error'] = true;
			$response['msg'] = "<b><span id='invalid'>***Invalid file Size or Type***<span></b>";
		} // end else of type & img size
	}else{// end if isset
		$response['error'] = true;
		$response['msg'] = 'Request faild, please try agin';
	}// end else of if iseet
}else{// end if request
	$response['error'] = true;
	$response['msg'] = 'Request faild, please try agin';
} // end else of if request


echo json_encode($response);

?>