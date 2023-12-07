<?php
include '../../connection/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    parse_str(file_get_contents("php://input"), $_PUT);

    $productId = $_PUT['id'];
    $productName = $_PUT['product_name'];
    $productDescription = $_PUT['product_description'];
    $productPrice = $_PUT['product_price'];
    $stockQuantity = $_PUT['stock_quantity'];
    $categoryName = $_PUT['category_name'];
    $brandName = $_PUT['brand_name'];


    $updateQuery = "UPDATE products SET product_name='$productName', product_description='$productDescription', product_price='$productPrice',
        stock_quantity='$stockQuantity', category_name='$categoryName', brand_name='$brandName' WHERE product_id='$productId'";

    if ($conn->query($updateQuery) === TRUE) {
        $response = array('status' => 'success', 'message' => 'Product updated successfully');
        echo json_encode($response);
    } else {
        $response = array('status' => 'error', 'message' => 'Error updating product: ' . $conn->error);
        echo json_encode($response);
    }

    $conn->close();
} else {
    http_response_code(405);
    $response = array('status' => 'error', 'message' => 'Invalid request method');
    echo json_encode($response);
}
?>
