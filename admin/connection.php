<?php
$sname = "localhost";
$username = "root";
$password = "";
$db_name = "airline_booking_system";

// Create connection
$conn = mysqli_connect($sname, $username, $password, $db_name);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Set charset to ensure proper communication with the database
mysqli_set_charset($conn, "utf8");

// Optional: Enable error reporting and exception handling for queries
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
?>