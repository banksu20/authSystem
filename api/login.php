<?php

    if(session_status() === PHP_SESSION_NONE){
        session_start(); 
    }

    header('Content-Type: application/json');

    require_once '../config/db.php';

    $response = ['status' => 'error', 'message' => 'An unexpected error occurred.'];

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';


        if(empty($username) || empty($password)){
            $response['message'] = 'Please enter your username and password';
            echo json_encode($response);
            exit;
        }

        try{
            $sql = "SELECT id, username, password FROM users WHERE username = :username";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->execute(); 

            $user = $stmt->fetch(PDO::FETCH_ASSOC);


            if($user){
                if(password_verify($password, $user['password'])){
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['logged_in'] = true;

                    $response['status'] = 'success';
                    $response['message'] = 'Login successful! Redirecting to dashboard...';
                    $response['redirect_url'] = 'dashboard.php';
                }else{
                    $response['message'] = 'Invalid username or password';
                }
            }else{
                $response['message'] = 'Invalid username or password';
            }


        }catch(PDOException $e){
            $response['message'] = 'Server error occurred ' . $e->getMessage();
        }
    }else{
        $response['message'] = 'Invalid request method';
    }
    echo json_encode($response);
    exit;

?>