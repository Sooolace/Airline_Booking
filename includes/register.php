<?php

$conn = mysqli_connect('localhost', 'root', '', 'airline_booking_system');
if (mysqli_connect_error()) {
    die('Connection Failed: ' . mysqli_connect_error());
}

// User registration
if (
    isset($_POST['username']) &&
    isset($_POST['password']) &&
    isset($_POST['birthdate']) &&
    isset($_POST['email'])
) {
    // Assign values to variables
    $username = $_POST['username'];
    $password = $_POST['password']; // Plain text password

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $birthdate = $_POST['birthdate'];
    $email = $_POST['email'];

    // Prepare and execute the SQL query
    $stmt_users = $conn->prepare("INSERT INTO users (username, `password`, birthdate, email) VALUES (?, ?, ?, ?)");
    $stmt_users->bind_param("ssss", $username, $hashed_password, $birthdate, $email);

    if ($stmt_users->execute()) {
        echo "User Registered successfully";
    } else {
        echo "Error" . $stmt_users->error;
    }

    $stmt_users->close();
} else {
    echo "One or more required fields are missing.";
}    

?>
