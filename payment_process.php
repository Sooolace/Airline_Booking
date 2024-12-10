<?php
session_start();
include "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['passenger_details'])) {
    // Retrieve passenger details from the session
    $passengers = $_SESSION['passenger_details'];
    $flight_id = $_SESSION['flight_id'];
    $user_id = $_SESSION['user_id'];
    $class = $_SESSION['class'];

    // Determine class ID based on the class name
    $class_id = ($class === 'Economy') ? 1 : (($class === 'Business Class') ? 2 : null);

    if ($class_id === null) {
        // Handle an unrecognized class name, maybe log an error or handle accordingly
        echo "Invalid class name.";
    } else {
        // Extract payment details from the form
        $card_no = $_POST['card_no'];
        $cardholder_name = $_POST['cardholder_name'];
        $base_price = $_SESSION['price']; // Base price per passenger

        // Calculate the total price based on the number of passengers
        $total_passengers = count($passengers);
        $price = $base_price * $total_passengers;

        // Loop through passengers and insert each one
        foreach ($passengers as $passenger) {
            $first_name = $passenger['first_name'];
            $middle_name = $passenger['middle_name'];
            $last_name = $passenger['last_name'];
            $phone_no = $passenger['phone_no'];
            $email = $passenger['email'];

            // Insert passenger details into the database using the determined class ID
            $insert_passenger_query = "INSERT INTO passengers (flight_id, user_id, first_name, middle_name, last_name, phone_no, email, class_id)
                             VALUES ('$flight_id', '$user_id', '$first_name', '$middle_name', '$last_name', '$phone_no', '$email', '$class_id')";

            $insert_passenger_result = mysqli_query($conn, $insert_passenger_query);

            if (!$insert_passenger_result) {
                // Handle the error for a specific passenger
                $error_message = "Error: " . mysqli_error($conn);
                echo $error_message;
                // You might want to handle or log this error for further investigation
            }
        }

        // Insert payment details into the database
        $insert_payment_query = "INSERT INTO payment (flight_id, user_id, card_no, date, amount)
                         VALUES ('$flight_id', '$user_id', '$card_no', NOW(), '$price')";

        $insert_payment_result = mysqli_query($conn, $insert_payment_query);

        if (!$insert_payment_result) {
            // Handle the error for payment insertion
            $error_message = "Error: " . mysqli_error($conn);
            echo $error_message;
            // You might want to handle or log this error for further investigation
        } else {
            // Clear the passenger details from the session after successful insertion
            unset($_SESSION['passenger_details']);

            // Redirect to my_flights.php after successful insertion
            header("Location: my_flights.php");
            exit();
        }
    }
}
?>
