<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'airline_booking_system');
if (mysqli_connect_error()) {
    die('Connection Failed: ' . mysqli_connect_error());
}

// Insert airlines
if (isset($_POST['city_name'])) {
    $city_name = $_POST['city_name'];

    $stmt_cities = $conn->prepare("INSERT INTO cities (city_name) VALUES (?)");
    $stmt_cities->bind_param("s", $city_name);

    if ($stmt_cities->execute()) {
        // Display a JavaScript alert and reload the page
        echo '<script>alert("City added successfully"); window.location = "../cities.php";</script>';
    } 
    $stmt_cities->close();
}
?>
