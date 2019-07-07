<?php


$response = array();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if( isset($_POST['id']) && isset($_POST['pass']) ){
        
        require_once ('userAPI.php');
        $result = updatePassword($_POST['id'] , $_POST['pass'] );
        if($result){
            $response['error'] = false;
            $response['msg'] = "Password update succeffully";
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