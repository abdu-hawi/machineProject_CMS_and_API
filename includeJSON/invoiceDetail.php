<?php


$response = array();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if( isset($_POST['id']) ){
        
        require_once ('invoiceAPI.php');
        $result = invoice_detail_get_by_id($_POST['id']);
        if($result){
            $response['error'] = false;
            $response['msg'] = $result;
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