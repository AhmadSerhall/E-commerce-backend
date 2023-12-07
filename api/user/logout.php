<?php
include '../../connection/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    session_start();
    if (isset($_SESSION['user_id'])) {
        $_SESSION = array();
        session_destroy();
        $response = array('status' => 'success', 'message' => 'User logged out successfully');
        echo json_encode($response);
    } else {
        $response = array('status' => 'error', 'message' => 'User not logged in');
        echo json_encode($response);
    }
} else {
    http_response_code(405); 
    $response = array('status' => 'error', 'message' => 'Invalid request method');
    echo json_encode($response);
}
?>
