<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'airline_booking_system');
if (mysqli_connect_error()) {
    die('Connection Failed: ' . mysqli_connect_error());
}

// Insert payment data
if (
    isset($_POST['flight_id']) &&
    isset($_POST['user_id']) &&
    isset($_POST['typeText']) &&
    isset($_POST['typeName']) &&
    isset($_POST['typeExp']) &&
    isset($_POST['typeText2'])
) {
    $flight_id = $_POST['flight_id'];
    $user_id = $_POST['user_id'];
    $card_number = $_POST['typeText'];
    $cardholder_name = $_POST['typeName'];
    $expiration = $_POST['typeExp'];
    $cvv = $_POST['typeText2'];
    $date = date('Y-m-d'); // Current date
    $amount = 100;

    $stmt_payment = $conn->prepare("INSERT INTO payment (card_no, user_id, flight_id, date, amount) VALUES (?, ?, ?, ?, ?)");
    $stmt_payment->bind_param("siisd", $card_number, $user_id, $flight_id, $date, $amount);

    if ($stmt_payment->execute()) {
        // Display a JavaScript alert and redirect to a success page
        echo '<script>alert("Payment added successfully"); window.location = "payment_success.php";</script>';
    } else {
        echo "Error adding payment: " . $stmt_payment->error;
    }
    
    $stmt_payment->close();
}
?>
