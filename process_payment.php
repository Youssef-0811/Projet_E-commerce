<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the payment information
    $cardNumber = $_POST["card_number"];
    $expiryDate = $_POST["expiry_date"];
    $cvv = $_POST["cvv"];
    $name = $_POST["name"];
    $address = $_POST["address"];
    $zipCode = $_POST["zip_code"];

    // Process the payment (you can simulate this for your project)
    $paymentResult = simulatePayment($cardNumber, $expiryDate, $cvv, $name, $address, $zipCode);

    // If payment is successful, show a success message with JavaScript
    if ($paymentResult == "Payment successful! Thank you, $name!") {
        echo "<script>alert('Payment successful! Thank you!'); window.location.href = 'accueil.php';</script>";
        exit();
    }

    // If payment is not successful, show an error message with JavaScript
    echo "<script>alert('Payment failed. Please try again.');</script>";
} else {
    // If the form is not submitted via POST, redirect to the index page
    header("Location: index.php");
    exit();
}

function simulatePayment($cardNumber, $expiryDate, $cvv, $name, $address, $zipCode)
{
    // Simulate payment processing
    // You can add your own logic or use a payment gateway API for a real implementation

    // For simulation purposes, just return a success message
    return "Payment successful! Thank you, $name!";
}
