<?php

$response = array();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	if(isset($_FILES["file"]["type"]) && isset($_POST['sectionName']) &&
			isset($_POST['itemName']) && isset($_POST['itemDesc']) &&
			isset($_POST['itemPrice']) ){
		
		if(!strcmp($_POST['sectionName'],"dd")){
			$response['error'] = true;
			$response['msg'] = " <span id='invalid'><b>Please select section</b></span> ";
			die(json_encode($response));
		}
		$validextensions = array("jpeg", "jpg", "png");
		$temporary = explode(".", $_FILES["file"]["name"]);
		$file_extension = end($temporary);
		
		if (( ($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")
				) && ($_FILES["file"]["size"] < 100000)//Approx. 100kb files can be uploaded.
				&& in_array($file_extension, $validextensions)) {
			if ($_FILES["file"]["error"] > 0) {
			echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
			} else { // end if of file error
				if (file_exists("../upload/" . $_FILES["file"]["name"])) {
					$response['error'] = true;
					$response['msg'] = $_FILES["file"]["name"] . " <span id='invalid'><b>already exists.</b></span> ";
					die(json_encode($response));
				}else{
                    // check for item name in db
                    require_once('../../incDB/db.php');
                    require_once('../../incDB/productItemAPI.php');
                    $item = product_get_by_name($_POST['itemName']);
                    if($item != NULL)
                    {
                        machine_db_close();
                        $response['error'] = true;
                        $response['msg'] = $_POST['itemName'] . " <span id='invalid'><b>already exists.</b></span> ";
                        die(json_encode($response));
                    }
                    // end check for item name in db
                    
					$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
					$targetPath = "../upload/".$_FILES['file']['name']; // Target path where file is to be stored
					move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
					
					$i_img_name = $_FILES["file"]["name"] ;
					
                    // insert to db
                    $n_name = trim($_POST['itemName']);
                    $n_sec = trim($_POST['sectionName']);
                    $n_desc = trim($_POST['itemDesc']);
                    $n_price = trim($_POST['itemPrice']);
                    $n_img = trim($i_img_name);
                    
                    $result = product_add($n_name,$n_sec,$n_desc,$n_price,$n_img);
                    
                    machine_db_close();
                    
                    if($result){
                        $response['error'] = false;
                        $response['msg'] = 'ok';
                    }
                    else{
                        $response['error'] = true;
                        $response['msg'] = $_POST['itemName'] . " <span id='invalid'><b>can't insert item, please try again.</b></span> ";
                        die(json_encode($response));
                    }
                    // end insert to db
				}
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