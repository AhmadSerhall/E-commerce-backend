<?php
header('Access-Control-Allow-Origin: *');
include '../../connection/connection.php';
require __DIR__ . '/../../vendor/autoload.php';

use Firebase\JWT\JWT;
//the code works even tho there is a red underline mistake
$username = $_POST['username'];
$password = $_POST['password'];
$query = $conn->prepare('SELECT user_id, username, user_type, password FROM users WHERE username=?');
$query->bind_param('s', $username); 
$query->execute();
$query->store_result();
$num_rows = $query->num_rows;
$query->bind_result($id, $username, $user_type, $hashed_password);
$query->fetch();

$response = [];
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
if ($num_rows == 0) {
    $response['status'] = 'user not found';
    echo json_encode($response);
} else {
    if (password_verify($password, $hashed_password)) {
        $key = "your_secret";
        $payload_array = [];
        $payload_array["user_id"] = $id;
        $payload_array["username"] = $username; 
        $payload_array["user_type"] = $user_type;
        $payload_array["exp"] = time() + 3600; 
        // $payload_array["user_role"] = $user_role; 
        $payload = $payload_array;
        $response['status'] = 'logged in';
        $jwt = JWT::encode($payload, $key, 'HS256');
        $response['jwt'] = $jwt;
        echo json_encode($response);
    } else {
        $response['status'] = 'wrong credentials';
        echo json_encode($response);
    }
}
?>
