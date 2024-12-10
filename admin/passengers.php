<?php
session_start();
include "includes/admin-header.php";
include "includes/admin-head.php";

if(isset($_POST['flight_id'])) {
    $flight_id = $_POST['flight_id'];
    
    // Connect to the database
    $con = mysqli_connect('localhost', 'root', '', 'airline_booking_system');
    
    // Retrieve passengers for the specific flight
    $query_passengers = "SELECT * FROM passengers WHERE flight_id = '$flight_id'";
    $query_passengers_run = mysqli_query($con, $query_passengers);
?>
    <h1 class="col-12 text-center mt-4">Passengers for Flight Code: <?= $flight_id ?></h1>

    <div class="col-md-12">
        <div class="card mt-4">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Last Name</th>
                            <th>Phone Number</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Display passengers in a table
                        if (mysqli_num_rows($query_passengers_run) > 0) {
                            foreach ($query_passengers_run as $passenger) {
                        ?>
                                <tr>
                                    <td><?= $passenger['first_name'] ?></td>
                                    <td><?= $passenger['middle_name'] ?></td>
                                    <td><?= $passenger['last_name'] ?></td>
                                    <td><?= $passenger['phone_no'] ?></td>
                                    <td><?= $passenger['email'] ?></td>
                                    
                                </tr>
                        <?php
                            }
                        } else {
                        ?>
                            <tr>
                                <td colspan="5">No Passengers Found for this Flight</td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php
} else {
    echo "Flight ID not provided.";
}
?>
