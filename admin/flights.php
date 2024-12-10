<?php
session_start();
    include "includes/admin-header.php";
    include "includes/admin-head.php";
?>

<div class="body">
    <h1>Add flights</h1>
    <div class="container1">
         <form action="includes/flight.php" method="post" id="flight-form">

            
            <!-- <div class="input-container">
                <label for="flight-code">Flight Code:</label>
                <input type="text" id="flight-code" placeholder="Enter flight code">
            </div> -->

            <div class="input-container">
                <label for="airlines_id">Airlines</label>
                <select id="airlines_id" name="airlines_id" placeholder="Select Airlines" required>
                    <option value="">Select Airlines</option>
                    <?php
                    // Include your database connection here
                    $con = mysqli_connect('localhost', 'root', '', 'airline_booking_system');

                    // Query to retrieve airlines from the 'airlines' table
                    $query = "SELECT * FROM airlines";

                    $query_run = mysqli_query($con, $query);

                    if (mysqli_num_rows($query_run) > 0) {
                        while ($row = mysqli_fetch_assoc($query_run)) {
                            echo "<option value='" . $row['airlines_id'] . "'>" . $row['airlines_name'] . "</option>";
                        }
                    } else {
                        echo "<option value=''>No Airlines Found</option>";
                    }

                    mysqli_close($con);
                    ?>
                </select>
            </div>
                    
            <div class="input-container">
                <label for="from">From</label>
                <select id="from" name="from" placeholder="Select City" required>
                    <option value="">Select City</option>
                    <?php

                    $con = mysqli_connect('localhost', 'root', '', 'airline_booking_system');
                    $query = "SELECT * FROM cities";
                    $query_run = mysqli_query($con, $query);

                    if (mysqli_num_rows($query_run) > 0) {
                        while ($row = mysqli_fetch_assoc($query_run)) {
                            echo "<option value='" . $row['city_name'] . "'>" . $row['city_name'] . "</option>";
                        }
                    } else {
                        echo "<option value=''>No City Found</option>";
                    }

                    mysqli_close($con);
                    ?>
                </select>
            </div>              
   
            <div class="input-container">
                <label for="to">To</label>
                <select id="to" name="to" placeholder="Select City" required>
                    <option value="">Select City</option>
                    <?php
                    // Include your database connection here
                    $con = mysqli_connect('localhost', 'root', '', 'airline_booking_system');

                    // Query to retrieve airlines from the 'airlines' table
                    $query = "SELECT * FROM cities";

                    $query_run = mysqli_query($con, $query);

                    if (mysqli_num_rows($query_run) > 0) {
                        while ($row = mysqli_fetch_assoc($query_run)) {
                            echo "<option value='" . $row['city_name'] . "'>" . $row['city_name'] . "</option>";
                        }
                    } else {
                        echo "<option value=''>No City Found</option>";
                    }

                    // Close the database connection
                    mysqli_close($con);
                    ?>
                </select>
            </div>          

            <div class="input-container">
                <label for="depart-time">Depart Time:</label>
                <input type="time" id="depart-time" name="depart_time" placeholder="Enter departure time" required onchange="calculateDuration()">
            </div>

            <div class="input-container">
                <label for="arrival-time">Arrival Time:</label>
                <input type="time" id="arrival-time" name="arrive_time" placeholder="Enter arrival time" required onchange="calculateDuration()">
            </div>

            <div class="input-container">
                <label for="departing-date">Departing Date:</label>
                <input type="date" id="departing-date" name="depart_date" placeholder="Enter departing date" required onchange="calculateDuration()">
            </div>

            <div class="input-container">
                <label for="arrival-date">Arrival Date:</label>
                <input type="date" id="arrival-date" name="arrive_date" placeholder="Enter arrival date" required onchange="calculateDuration()">
            </div>

            <div class="input-container">
                <label for="price">Flight Price</label>
                <input type="number" id="price" name="price" placeholder="Enter price" required>
            </div>

            <div class="input-container">
                <label for="duration">Duration:</label>
                <input type="text" id="duration" name="duration" placeholder="Flight Duration" required readonly>
            </div>

            <div class="input-container">
                <input type="submit" class="btn btn-primary" value="Add flight">
            </div>
                    
        </form>
    </div>

    <div class="tablecontainer1">
    <div class="row">
        <div class="col-md-7">
            <form action="" method="GET">
                <div class="input-group mb-3">
                    <input type="text" name="search" value="<?php if(isset($_GET['search'])){echo $_GET['search'];} ?>" class="form-control" placeholder="Search Data">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>
        </div>
        <div class="col-md-12">
            <div class="card mt-4">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr >
                                <th class="col-md-sm">Code</th>
                                <th>From</th>
                                <th>Destination</th>
                                <th>Airline Code</th>
                                <th>Depart Time</th>
                                <th>Arrive Time</th>
                                <th>Depart Date</th>
                                <th>Arrive Date</th>
                                <th>Price</th>
                                <th class="col-md-sm">Duration</th>
                                <th>Action</th>                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $con = mysqli_connect('localhost', 'root', '', 'airline_booking_system');

                            // Check if the search parameter is set
                            if (isset($_GET['search'])) {
                                $filtervalues = $_GET['search'];
                                // Modify the SQL query to perform a search
                                $query = "SELECT * FROM flights WHERE CONCAT(flight_id, Airline, `from`, `to`) LIKE '%$filtervalues%'";
                            } else {
                                // If no search parameter is provided, select all records
                                $query = "SELECT * FROM flights";
                            }

                            $query_run = mysqli_query($con, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                foreach ($query_run as $items) {
                            ?>
                                    <tr>
                                        <td><?= $items['flight_id'] ?> </td>
                                        <td><?= $items['from'] ?> </td>
                                        <td><?= $items['to'] ?> </td>
                                        <td><?= $items['airlines_id'] ?> </td>
                                        <td><?= $items['depart_time'] ?> </td>
                                        <td><?= $items['arrive_time'] ?> </td>
                                        <td><?= $items['depart_date'] ?> </td>
                                        <td><?= $items['arrive_date'] ?> </td>
                                        <td><?= $items['price'] ?> </td>
                                        <td><?= $items['duration'] ?> </td>
                                        <td>
                                            <form action="connection.php" method="post">
                                                <input type="hidden" name="flight_id" value="<?= $items['flight_id'] ?>">
                                                <button type="submit" class="btn btn-danger btn-sm" name="delete">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                            <?php
                                }
                            } else {
                            ?>
                                <tr>
                                    <td colspan="4">No Record Found</td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
