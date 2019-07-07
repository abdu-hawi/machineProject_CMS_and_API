<?php

$response = array();
if($_SERVER['REQUEST_METHOD'] == 'POST'){

     require_once ('systemMachineAPI.php');
        
        $result = get_sm();
        if($result != NULL){
            $response['error'] = false;
            $response['msg'] = $result;
        }else{
            $response['error'] = true;
            $response['msg'] = 'We Found Some Mistake';
        }
}else{
    $response['error'] = true;
    $response['msg'] = 'Cannot connect to server';
}

echo json_encode($response);

?>