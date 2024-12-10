<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'airline_booking_system');
if (mysqli_connect_error()) {
    die('Connection Failed: ' . mysqli_connect_error());
}

// Insert airlines
if (isset($_POST['airlines_name']) && isset($_POST['seats'])) {
    $airlines_name = $_POST['airlines_name'];
    $seats = $_POST['seats'];

    $stmt_airlines = $conn->prepare("INSERT INTO airlines (airlines_name, seats) VALUES (?, ?)");
    $stmt_airlines->bind_param("si", $airlines_name, $seats);

    if ($stmt_airlines->execute()) {
        // Display a JavaScript alert and reload the page
        echo '<script>alert("Airline added successfully"); window.location = "../airlines.php";</script>';
    } else {
        echo "Error adding airline: " . $stmt_airlines->error;
    }
    
    $stmt_airlines->close();
}
?>
