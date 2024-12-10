<?php
session_start();
    include "includes/admin-header.php";
    include "includes/admin-head.php";
?>

<div class="body">
    <h1>Add City</h1>
    <div class="container1">
    <form action="includes/city.php" method="post" id="flight-form">
        <div class="input-container">
            <label for="city_name">City Name</label>
            <input type="text" id="city_name" placeholder="Enter city name" name="city_name" required>
        </div>
        <div class="input-container">
            <input type="submit" class="btn btn-primary" value="Add City">
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
                                $query = "SELECT * FROM cities WHERE CONCAT(city_name) LIKE '%$filtervalues%'";
                            } else {
                                // If no search parameter is provided, select all records
                                $query = "SELECT * FROM cities";
                            }

                            $query_run = mysqli_query($con, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                foreach ($query_run as $items) {
                            ?>
                                    <tr>
                                    
                                        <td><?= $items['city_name'] ?> </td>
                                        <td>
                                            <form action="connection.php" method="post">
                                
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
