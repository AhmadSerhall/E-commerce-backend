<?php
include '../../connection/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = isset($_POST['first_name']) ? $_POST['first_name'] : '';
    $lastName = isset($_POST['last_name']) ? $_POST['last_name'] : '';
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $userType = isset($_POST['user_type']) ? $_POST['user_type'] : '';

    $insertQuery = "INSERT INTO users (first_name, last_name, username, password, user_type) 
                    VALUES ('$firstName', '$lastName', '$username', '$password', '$userType')";

    if ($conn->query($insertQuery) === TRUE) {
        $response = array('status' => 'success', 'message' => 'User created successfully');
        echo json_encode($response);
    } else {
        $response = array('status' => 'error', 'message' => 'Error creating user: ' . $conn->error);
        echo json_encode($response);
    }
    $conn->close();
} else {
    http_response_code(405); 
    $response = array('status' => 'error', 'message' => 'Invalid request method');
    echo json_encode($response);
}
?>
