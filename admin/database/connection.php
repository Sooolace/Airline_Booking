<?php

// Connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'airline_booking_system');
if (mysqli_connect_error()) {
    die('Connection Failed: ' . mysqli_connect_error());
}

// Insert passenger
if (isset($_POST['first_name']) && isset($_POST['middle_name']) && isset($_POST['last_name']) && isset($_POST['phone_no']) && isset($_POST['email'])) {
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $phone_no = $_POST['phone_no'];
    $email = $_POST['email'];

    $stmt_passenger = $conn->prepare("INSERT INTO passengers (first_name, middle_name, last_name, phone_no, email) VALUES (?, ?, ?, ?, ?)");


    $stmt_passenger->bind_param("sssis", $first_name, $middle_name, $last_name, $phone_no, $email);

    if ($stmt_passenger->execute()) {
        // Redirect to payment.php
        header("Location: ../../payment.php");
        exit(); // Terminate the script to ensure the redirection is performed.
    } else {
        echo "Error adding passenger: " . $stmt_passenger->error;
    }
    

    $stmt_passenger->close();
}

// Search flights
if (isset($_GET['search'])) {
    $from = mysqli_real_escape_string($conn, $_GET['from']);
    $to = mysqli_real_escape_string($conn, $_GET['to']);
    $departDate = mysqli_real_escape_string($conn, $_GET['departDate']);

    $query = "SELECT * FROM flights WHERE `from` = '$from' AND `to` = '$to' AND depart_date = '$departDate'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $html = '';
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $html .= "<tr>";
                $html .= "<td>" . $row['flight_id'] . "</td>";
                $html .= "<td>" . $row['from'] . "</td>";
                $html .= "<td>" . $row['to'] . "</td>";
                $html .= "</tr>";
            }
        } else {
            $html .= "<tr><td colspan='9'>No Record Found</td></tr>";
        }
        echo $html;
    } else {
        echo "Error executing the search query: " . mysqli_error($conn);
    }
}

// // Delete flight (use prepared statement)
// if (isset($_POST['delete'])) {
//     $flight_id = $_POST['flight_id'];
//     $stmt_delete_flight = $conn->prepare("DELETE FROM flights WHERE flight_id = ?");
//     $stmt_delete_flight->bind_param("i", $flight_id);

//     if ($stmt_delete_flight->execute()) {
//         header("Location: ../index.php");
//     } else {
//         echo "Error: " . $stmt_delete_flight->error;
//     }

//     $stmt_delete_flight->close();
// }

// Close the database connection
$conn->close();

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


