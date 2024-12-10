<?php
include "connection.php"; 
include "includes/header.php";
include "includes/head.php";
include "includes/footer.php";
?>

<?php

function getFlightStatus($departDateTime, $arriveDateTime) {
    $currentDateTime = date('Y-m-d H:i:s'); 

    if ($currentDateTime > $arriveDateTime) {
        return 'Arrived';
    } elseif ($currentDateTime > $departDateTime) {
        return 'Departed';
    } else {
        return 'Not Departed Yet';
    }
}
?>

<h1 class="col-12 text-center">Booked Flights</h1>

    <?php
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id']; // Fetching user ID from the session

        $query = "SELECT p.*, f.from, f.to, f.depart_time, f.airlines_id, f.arrive_time, f.depart_date, f.arrive_date 
                  FROM passengers p
                  INNER JOIN flights f ON p.flight_id = f.flight_id
                  WHERE p.user_id = '$user_id'";

        $query_run = mysqli_query($conn, $query);

        if ($query_run) {
            if (mysqli_num_rows($query_run) > 0) {
                echo '<table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Flight ID</th>
                                <th>Name</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Airline</th>
                                <th>Schedule of Departure</th>
                                <th>Schedule of Arrival</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>';

                while ($row = mysqli_fetch_assoc($query_run)) {
                    $status = getFlightStatus($row['depart_date'] . ' ' . $row['depart_time'], $row['arrive_date'] . ' ' . $row['arrive_time']);
                    $statusClass = '';

                    // Assign different CSS classes based on the status
                    switch ($status) {
                        case 'Arrived':
                            $statusClass = 'bg-success text-light'; // Green background for arrived flights
                            break;
                        case 'Departed':
                            $statusClass = 'bg-info text-light'; // Blue background for departed flights
                            break;
                        case 'Not Departed Yet':
                            $statusClass = 'bg-warning'; // Yellow background for flights not departed yet
                            break;
                        default:
                            $statusClass = ''; // Default or additional status can be handled here
                    }

                    // Output rows with different background colors based on status
                    echo "<tr>
                    <td style='width: 20px;'>{$row['flight_id']}</td>
                    <td style='width: 200px;'>{$row['first_name']} {$row['last_name']}</td>
                    <td style='width: 150px;'>{$row['from']}</td>
                    <td style='width: 150px;'>{$row['to']}</td>
                    <td style='width: 200px;'>{$row['airlines_id']}</td>
                    <td style='width: 200px;'>{$row['depart_date']} {$row['depart_time']}</td>
                    <td style='width: 200px;'>{$row['arrive_date']} {$row['arrive_time']}</td>
                    <td class='$statusClass' style='width: 250px;'>$status</td>
                    <td style='width: 100px;'><a href='ticket.php?flight_id={$row['flight_id']}&passenger_id={$row['passenger_id']}' class='btn btn-primary'>View Ticket</a></td>
                </tr>";

                }
                echo '</tbody></table>';
            } else {
                echo "<p>No booked flights found.</p>";
            }
        } else {
            echo "<p>Error fetching booked flights.</p>";
        }
    } else {
        header("Location: login.php");
        exit();
    }
    ?>
</div>

<?php include "includes/footer.php"; ?>
