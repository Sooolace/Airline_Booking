<?php

// Connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'airline_booking_system');
if (mysqli_connect_error()) {
    die('Connection Failed: ' . mysqli_connect_error());
}

// User registration
if (
    isset($_POST['username']) &&
    isset($_POST['password'])
) {
    // Assign values to variables
    $username = $_POST['username'];
    $password = $_POST['password']; // Plain text password

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and execute the SQL query
    $stmt_users = $conn->prepare("INSERT INTO `admin` (username, `password`) VALUES (?, ?)");
    $stmt_users->bind_param("ss", $username, $hashed_password);

    if ($stmt_users->execute()) {
        echo "User Registered successfully";
    } else {
        echo "Error" . $stmt_users->error;
    }

    // Close the prepared statement
    $stmt_users->close();
} else {
    echo "One or more required fields are missing.";
}    

?>
