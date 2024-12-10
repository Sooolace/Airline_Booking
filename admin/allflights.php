<?php
session_start();
    include "includes/admin-header.php";
    include "includes/admin-head.php";
?>

        <h1 class="col-12 text-center">Flight List</h1>

        <div class="row justify-content-center mt-4"> <!-- Center the entire row -->
            <div class="col-md-5">
                <form action="" method="GET">
                    <div class="input-group mb-3">
                        <input type="text" name="search" value="<?php if(isset($_GET['search'])){echo $_GET['search'];} ?>" class="form-control" placeholder="Search Data">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
                <div class="col-md-12">
            <div class="card mt-4">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr >
                                <th class="col-md-sm">Flight Code</th>
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
                            $query = "SELECT * FROM flights";
                            if (isset($_GET['search'])) {
                                $filtervalues = $_GET['search'];
                                // Modify the SQL query to perform a search
                                $query .= " WHERE CONCAT(flight_id, airlines_id, `from`, `to`) LIKE '%$filtervalues%'";
                            }
                            $query .= " ORDER BY flight_id DESC";
                            

                            $query_run = mysqli_query($con, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                foreach ($query_run as $items) {
                            ?>
                                    <tr>
                                        <td style="width: 120px;"><?= $items['flight_id'] ?> </td>
                                        <td><?= $items['from'] ?> </td>
                                        <td><?= $items['to'] ?> </td>
                                        <td><?= $items['airlines_id'] ?> </td>
                                        <td><?= $items['depart_time'] ?> </td>
                                        <td><?= $items['arrive_time'] ?> </td>
                                        <td><?= $items['depart_date'] ?> </td>
                                        <td><?= $items['arrive_date'] ?> </td>
                                        <td><?= $items['price'] ?> </td>
                                        <td style="width: 120px;"><?= $items['duration'] ?> </td>
                                        <td style="width: 150px;">
                                            <form action="passengers.php" method="post">
                                                <input type="hidden" name="flight_id" value="<?= $items['flight_id'] ?>">
                                                <button type="submit" class="btn btn-primary btn-sm" name="delete">View Passengers</button>
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