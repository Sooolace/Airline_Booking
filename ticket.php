<?php
include "connection.php"; 
include "includes/header.php";
include "includes/head.php";
include "includes/footer.php";
?>

<style>
    body {
        font-family: Arial, sans-serif;
    }

    .ticket {
        max-width: 400px;
        margin: 20px auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 8px;
        background-color: #f9f9f9;
        margin-bottom: 20px;
    }

    .ticket-header {
        text-align: center;
        font-weight: bold;
        font-size: 24px;
        margin-bottom: 20px;
    }

    .ticket-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 10px;
    }

    .ticket-table th,
    .ticket-table td {
        padding: 8px;
        text-align: left;
    }

    .ticket-table th {
        background-color: #ddd;
    }

    .ticket-table td {
        border-bottom: 1px solid #ddd;
    }
</style>

<div class="ticket">
    <?php
    if (isset($_GET['flight_id']) && isset($_GET['passenger_id'])) {
        $flight_id = $_GET['flight_id'];
        $passenger_id = $_GET['passenger_id'];

        $query = "SELECT p.*, '22C' AS seat_number, f.from, f.to 
                  FROM passengers p
                  INNER JOIN flights f ON p.flight_id = f.flight_id
                  WHERE p.flight_id = '$flight_id' AND p.passenger_id = '$passenger_id'";

        $query_run = mysqli_query($conn, $query);

        if ($query_run && mysqli_num_rows($query_run) > 0) {
            $passenger = mysqli_fetch_assoc($query_run);
            echo '<div class="ticket">';
            echo '<div class="ticket-header">Flight Ticket</div>';
            echo '<p><strong>From:</strong> ' . $passenger['from'] . '</p>';
            echo '<p><strong>To:</strong> ' . $passenger['to'] . '</p>';

            echo '<table class="ticket-table">
                    <tr>
                        <th>Name</th>
                        <th>Seat Number</th>
                    </tr>';
            
            echo "<tr>
                    <td>{$passenger['first_name']} {$passenger['last_name']}</td>
                    <td>{$passenger['seat_number']}</td>
                  </tr>";
            
            echo '</table>';
            echo '</div>';
        } else {
            echo "<p>No passenger details found for this flight.</p>";
        }
    } else {
        echo "<p>No flight ID or passenger ID specified.</p>";
    }
    ?>
</div>

<?php include "includes/footer.php"; ?>
