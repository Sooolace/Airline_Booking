<?php
session_start();
include "includes/admin-header.php";
include "includes/admin-head.php";
?>


<div class="body">
    <h1>Add aircraft</h1>
    <div class="container1">
        <form id="flight-form">
            <div class="input-container">
                <label for="aircraft-code">Aircraft Code</label>
                <input type="text" id="aircraft-code" placeholder="Enter Aircraft Code">
            </div>

            <div class="input-container">
                <label for="aircraft-model">Aircraft model</label>
                <input type="text" id="aircraft-model" placeholder="Enter aircraft model">
            </div>

            <div class="input-container">
                <label for="Aircraft-name">Aircraft Name</label>
                <input type="text" id="ircraft-name" placeholder="Aircraft Name">
            </div>

            <div class="input-container">
                <label for="economy">Economy Seats Capacity</label>
                <input type="text" id="economy" placeholder="Economy Seats">
            </div>
            <div class="input-container">
                <label for="business-class">Business Class Seats Capacity</label>
                <input type="text" id="business-class" placeholder="Economy Seats">
            </div>

            <div class="input-container">
                <label for="First Class">First Class Seats Capacity</label>
                <input type="text" id="First Class" placeholder="Enter departing date">
            </div>

            <div class="input-container">
                <button type="button" id="add-flight-button">Add Flight</button>
                <button type="button" id="delete-button">Delete</button>
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
                            <tr>
                                <th>Aircraft Code</th>
                                <th>Model</th>
                                <th>Name</th>
                                <th>Manufacturer</th>
                                <th>Economy Seats</th>
                                <th>Business Seats</th>
                                <th>Comfort Seats</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $con = mysqli_connect('localhost', 'root', '', 'airline_booking_system');

                            // Check if the search parameter is set
                            if (isset($_GET['search'])) {
                                $filtervalues = $_GET['search'];
                                // Modify the SQL query to perform a search
                                $query = "SELECT * FROM aircraft WHERE CONCAT(aircraft_code, model, aircraft_name, manufacturer) LIKE '%$filtervalues%'";
                            } else {
                                // If no search parameter is provided, select all records
                                $query = "SELECT * FROM aircraft";
                            }

                            $query_run = mysqli_query($con, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                foreach ($query_run as $items) {
                            ?>
                                    <tr>
                                        <td><?= $items['aircraft_code'] ?> </td>
                                        <td><?= $items['model'] ?> </td>
                                        <td><?= $items['aircraft_name'] ?> </td>
                                        <td><?= $items['manufacturer'] ?> </td>
                                        <td><?= $items['economy_seats'] ?> </td>
                                        <td><?= $items['business_seats'] ?> </td>
                                        <td><?= $items['comfort_seats'] ?> </td>
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
