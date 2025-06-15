<?php
    header('Content-Type: application/json');

    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }

    $response = ['status' => 'error', 'message' => 'logout failed'];

    $_SESSION = array();

    if(session_destroy()) {
        $response['status'] = 'success';
        $response['message'] = 'logged out successfully';
     }else{
        $response['message'] = 'failed to destroy the session';
     }
     echo json_encode($response);
     exit;


?>