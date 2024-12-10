<?php
session_start();
include "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['passenger_details'])) {
    // Extract payment details from the form
    $card_no = $_POST['card_no'];
    $cardholder_name = $_POST['cardholder_name'];
    $price = $_SESSION['passenger_details']['price'];
    

    // Store payment details temporarily in session
    $_SESSION['payment_details'] = [
        'card_no' => $card_no,
        'cardholder_name' => $cardholder_name,
        'price' => $price,
    ];

    // Redirect to the payment gateway or payment confirmation page
    header("Location: payment.php");
    exit();
}
?>
