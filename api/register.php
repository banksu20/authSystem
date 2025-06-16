<?php

header('Content-Type: application/json');

require_once '../config/db.php';

function sendDiscordNotification($username, $email){
    $webhook_url = 'https://discord.com/api/webhooks/1384191221836021771/ganD5T_9syHDRhVcLZm8i93wOD8a_tpe_Dz--1ALHGm05QHw4BuyX826FbC6C09RfN4c';

    $timestamp = date("c", strtotime("now"));
    $json_data = json_encode([
        "content" => "🎉 New User Registration",
        "username" => "Registration Bot",
        "avatar_url" => "https://i.imgur.com/4M34hi2.png",
        "embeds" => [
            [
                "title" => "A new user has successfully registered.",
                "type" => "rich",
                "timestamp" => $timestamp,
                "color" => hexdec("00FF00"),
                "fields" => [
                    [
                        "name" => "Username",
                        "value" => $username,
                        "inline" => true
                    ],
                    [
                        "name" => "Email",
                        "value" => $email,
                        "inline" => true
                    ]
                    ],
                    "footer" => [
                        "text" => "Send form PHP Registration System",  
                    ]
            ]
        ]
                    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

                    // use CURL -> POST request to Webhook URL
        $ch = curl_init($webhook_url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
}

$response = ['status' => 'error', 'message' => 'An unexpected error occurred.'];

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if(empty($username) || empty($email) || empty($password) || empty($confirm_password)){
        $response['message'] = 'Please fill in all fields';
        echo json_encode($response);
        exit;
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $response['message'] = 'Email format is invalid';
        echo json_encode($response);
        exit;
    }

    if(strlen($password < 8)){
        $response['message'] = 'Password must be at least 8 character long';
        echo json_encode($response);
        exit;
    }

    if($password !== $confirm_password){
        $response['message'] = 'Password and Confirm password do not match';
        echo json_encode($response);
        exit;
    }

    try{
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(":username", $username);
        $stmt->execute();

        if($stmt->fetch()){
            $response['message'] = 'This username is already in use';
            echo json_encode($response);
            exit;
        }

        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        if($stmt->fetch()){
            $response['message'] = 'This email is already in use';
            echo json_encode($response);
            exit;
        }

        $hash_password = password_hash($password, PASSWORD_DEFAULT);
        
        $sql = "INSERT INTO users (username, email, password) VALUES(:username, :email, :password)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $hash_password);

        if($stmt->execute()){
            $response['status'] = 'success';
            $response['message'] = 'Registration is successful! You can now Login';

            sendDiscordNotification($username, $email);
        }else{
            $response['message'] = 'An error occurred while saving da   xta to the database';
        }

    }catch(PDOException $e){
        $response['message'] = 'A server error occurred ' . $e->getMessage();
    }

}else{
    $response['message'] = 'Invalid request method.';
}

echo json_encode($response);
exit; 


?>