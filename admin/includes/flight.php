<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (
    isset($_POST['from']) &&
    isset($_POST['to']) &&
    isset($_POST['airlines_id']) &&
    isset($_POST['depart_time']) &&
    isset($_POST['arrive_time']) &&
    isset($_POST['depart_date']) &&
    isset($_POST['arrive_date']) &&
    isset($_POST['price']) &&
    isset($_POST['duration'])
) {
    // Connect to the database
    $conn = mysqli_connect('localhost', 'root', '', 'airline_booking_system');
    if (mysqli_connect_error()) {
        die('Connection Failed: ' . mysqli_connect_error());
    }

    // Assign values to variables
    $from = $_POST['from'];
    $to = $_POST['to'];
    $airlines_id = $_POST['airlines_id']; 
    $depart_time = $_POST['depart_time'];
    $arrive_time = $_POST['arrive_time'];
    $depart_date = $_POST['depart_date'];
    $arrive_date = $_POST['arrive_date'];
    $price = $_POST['price'];
    $duration = $_POST['duration'];

    // Prepare and execute the SQL query
    $stmt_flights = $conn->prepare("INSERT INTO flights (`from`, `to`, airlines_id, depart_time, arrive_time, depart_date, arrive_date, price, duration) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt_flights->bind_param("ssisssssi", $from, $to, $airlines_id, $depart_time, $arrive_time, $depart_date, $arrive_date, $price, $duration); // Changed 's' to 'i' for integer type

    if ($stmt_flights->execute()) {
        // Display a JavaScript alert and reload the page
        echo '<script>alert("Flight added successfully"); window.location = "../flights.php";</script>';
    } else {
        echo "Error adding flight: " . mysqli_error($conn); // Display SQL errors
    }

    // Close the prepared statement and database connection
    $stmt_flights->close();
    $conn->close();
}
?>
