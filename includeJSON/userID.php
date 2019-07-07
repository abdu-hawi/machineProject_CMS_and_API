<?php

$response = array();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if( isset($_POST['phone']) ){
        
        require_once ('userAPI.php');
        
        $result = get_user_id_by_phone($_POST['phone'] );
        if($result){
            $response['error'] = false;
            $response['msg'] = $result['u_id'];
        }else{
            $response['error'] = true;
            $response['msg'] = 'The mobile number is incorrect';
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