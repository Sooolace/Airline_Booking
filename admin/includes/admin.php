<?php

// Connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'airline_booking_system');
if (mysqli_connect_error()) {
    die('Connection Failed: ' . mysqli_connect_error());
}

// admin login
$conn = mysqli_connect('localhost', 'root', '', 'airline_booking_system');
if (mysqli_connect_error()) {
    die('Connection Failed: ' . mysqli_connect_error());
}

// Admin login
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query the database to check for the entered admin credentials
    $stmt_admin = $conn->prepare("SELECT * FROM admin WHERE username = ? AND password = ?");
    $stmt_admin->bind_param("ss", $username, $password);
    $stmt_admin->execute();
    $result_admin = $stmt_admin->get_result();

    if ($result_admin->num_rows > 0) {
        // Authentication successful
        // Redirect to admin.php
        header("Location: ../admin.php");
        exit(); // Terminate the script to ensure the redirection is performed
    } else {
        // Authentication failed
        // You can redirect the admin back to the login page or show an error message
        echo "Invalid admin username or password";
    }

    $stmt_admin->close();
}

// Close the database connection
$conn->close();

?>


