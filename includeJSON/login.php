<?php

$response = array();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if( isset($_POST['phone']) and isset($_POST['password'])  ){
        
        require_once ('userAPI.php');
        
        $result = userLogin($_POST['phone'] , $_POST['password'] );
        if($result){
            $row = get_user_by_phone($_POST['phone']);
            $response['error'] = false;
            $response['msg'] = 0;
            $response['id'] = $row['u_id'];
            $response['name'] = $row['u_name'];
            $response['phone'] = $row['u_mobile'];
        }else{
            $response['error'] = true;
            $response['msg'] = 'The mobile number or password is incorrect';
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