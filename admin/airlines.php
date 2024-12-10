<?php
session_start();
    include "includes/admin-header.php";
    include "includes/admin-head.php";
?>

<div class="body">
    <h1>Add Airline</h1>
    <div class="container1">
    <form action="includes/airline.php" method="post" id="flight-form">
        <div class="input-container">
            <label for="airlines-name">Airline Name</label>
            <input type="text" id="airlines_name" placeholder="Enter airline name" name="airlines_name" required>
        </div>
        <div class="input-container">
            <label for="seats">Seats</label>
            <input type="number" id="seats" placeholder="Enter number of seats" name="seats" required>
        </div>
        <div class="input-container">
            <input type="submit" class="btn btn-primary" value="Add Airline">
        </div>
    </form>

            <!-- <div id="success-message" style="display: none;">
                     Data added successfully.
            </div> -->

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
                            <tr>
                                <th>Name</th>
                                <th>Seats</th>
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
                                $query = "SELECT * FROM airlines WHERE CONCAT(airlines_name) LIKE '%$filtervalues%'";
                            } else {
                                // If no search parameter is provided, select all records
                                $query = "SELECT * FROM airlines";
                            }

                            $query_run = mysqli_query($con, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                foreach ($query_run as $items) {
                            ?>
                                    <tr>
                                    
                                        <td><?= $items['airlines_name'] ?> </td>
                                        <td><?= $items['seats'] ?> </td>
                                        <td>
                                            <form action="connection.php" method="post">
                                                <input type="hidden" name="airlines_id" value="<?= $items['airlines_id'] ?>">
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
