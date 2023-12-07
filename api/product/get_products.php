<?php
include '../../connection/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $selectQuery = "SELECT * FROM products";
    $result = $conn->query($selectQuery);
    if ($result) {
        if ($result->num_rows > 0) {
            $productData = array();
            while ($row = $result->fetch_assoc()) {
                $productData[] = $row;
            }
            $response = array('status' => 'success', 'data' => $productData);
            echo json_encode($response);
        } else {
            $response = array('status' => 'error', 'message' => 'No products found');
            echo json_encode($response);
        }
    } else {
        $response = array('status' => 'error', 'message' => 'Error retrieving products: ' . $conn->error);
        echo json_encode($response);
    }
    $conn->close();
} else {
    http_response_code(405); 
    $response = array('status' => 'error', 'message' => 'Invalid request method');
    echo json_encode($response);
}
?>
