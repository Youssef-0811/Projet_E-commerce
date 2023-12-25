<?php
session_start();

if (isset($_SESSION['user_name'])) {
    // User is logged in, handle adding to the cart
    $productId = $_POST['productId']; // Make sure to sanitize and validate user input
    // Add the product to the user's cart in the session or database
    // Example: $_SESSION['cart'][] = $productId;
    echo json_encode(['success' => true, 'message' => 'Product added to cart']);
} else {
    // User is not logged in, handle accordingly
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
}
