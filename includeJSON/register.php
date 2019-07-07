<?php


$response = array();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if( isset($_POST['name']) and isset($_POST['password']) and isset($_POST['phone']) ){
        
        require_once ('userAPI.php');
        
        $result = create_user($_POST['name'] , $_POST['password'] , $_POST['phone']);
        if($result == 1){
            $response['error'] = true;
            $response['msg'] = "The phone number is exists";
        }elseif($result == 2){
            $response['error'] = false;
            $response['msg'] = "Users register succeffully"; 
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