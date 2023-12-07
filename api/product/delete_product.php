<?php
include '../../connection/connection.php';
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $productId = $_GET['id'];
    $deleteQuery = "DELETE FROM products WHERE product_id = $productId";
    if ($conn->query($deleteQuery) === TRUE) {
        $response = array('status' => 'success', 'message' => 'Product deleted successfully');
        echo json_encode($response);
    } else {    
        $response = array('status' => 'error', 'message' => 'Error deleting product: ' . $conn->error);
        echo json_encode($response);
    }
    $conn->close();
} else {
    http_response_code(405); 
    $response = array('status' => 'error', 'message' => 'Invalid request method');
    echo json_encode($response);
}
?>
