<?php
include '../../connection/connection.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 
    $productName = $_POST['product_name'];
    $productDescription = $_POST['product_description'];
    $productPrice = $_POST['product_price'];
    $stockQuantity = $_POST['stock_quantity'];
    $categoryName = $_POST['category_name'];
    $brandName = $_POST['brand_name'];

    $insertQuery = "INSERT INTO products (product_name, product_description, product_price, stock_quantity, category_name, brand_name) 
                    VALUES ('$productName', '$productDescription', '$productPrice', '$stockQuantity', '$categoryName', '$brandName')";

if ($conn->query($insertQuery) === TRUE) {
    $response = array('status' => 'success', 'message' => 'Product created successfully');
    echo json_encode($response);
} else {
    $response = array('status' => 'error', 'message' => 'Error creating product: ' . $conn->error);
    echo json_encode($response);
}
    $conn->close();
} else {
    http_response_code(405); 
    $response = array('status' => 'error', 'message' => 'Invalid request method');
    echo json_encode($response);
}

?>
