<?php
include '../../connection/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $productId = $_GET['id'];
    $selectQuery = "SELECT * FROM products WHERE product_id = $productId";
    $result = $conn->query($selectQuery);
    if ($result) {
        if ($result->num_rows > 0) {
            $productData = $result->fetch_assoc();
            $response = array('status' => 'success', 'data' => $productData);
            echo json_encode($response);
        } else {
            $response = array('status' => 'error', 'message' => 'Product not found');
            echo json_encode($response);
        }
    } else {
        $response = array('status' => 'error', 'message' => 'Error retrieving product: ' . $conn->error);
        echo json_encode($response);
    }
    $conn->close();
} else {
    http_response_code(405); 
    $response = array('status' => 'error', 'message' => 'Invalid request method');
    echo json_encode($response);
}
?>
