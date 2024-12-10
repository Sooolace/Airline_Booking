<?php
session_start();

// Unset the passenger_count session variable
unset($_SESSION['passenger_count']);

// Set it back to "1"
$_SESSION['passenger_count'] = 1;

// Redirect to index.php
header("Location: index.php");
exit();
?>
