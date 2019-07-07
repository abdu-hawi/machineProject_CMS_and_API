<?php


$response = array();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if( isset($_POST['id']) && isset($_POST['name']) && isset($_POST['phone']) && isset($_POST['email']) ){
        
        require_once ('userAPI.php');
        $result = userUpdateInfo($_POST['id'] , $_POST['phone'] , $_POST['email'] , $_POST['name']);
        if($result){
            $response['error'] = false;
            $response['msg'] = "Users update succeffully";
        }else{
            $response['error'] = true;
            $response['msg'] = 'some mistake';
        }
    }else{
        $response['error'] = true;
        $response['msg'] = 'All filed required';
    }
}else{
    $response['error'] = true;
    $response['msg'] = 'Cannot connect to server';
}

echo json_encode($response);

?>