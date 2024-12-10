<?php
session_start();

$isLoggedIn = isset($_SESSION['admin_id']) && isset($_SESSION['username']);

// Check if the user is not logged in, redirect to login page
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

include "includes\admin-header.php";
include "includes\admin-head.php";

date_default_timezone_set('Asia/Shanghai');
$currentDate = date('Y-m-d');

$con = mysqli_connect('localhost', 'root', '', 'airline_booking_system');

if (!$con) {
    die('Connection Failed: ' . mysqli_connect_error());
}

// Query for Total Count of Passengers
$queryPassengerCount = "SELECT COUNT(*) as total_passengers FROM passengers";
$resultPassengerCount = mysqli_query($con, $queryPassengerCount);
$rowPassengerCount = mysqli_fetch_assoc($resultPassengerCount);
$totalPassengers = $rowPassengerCount['total_passengers'];

// Query for Total Count of Flights
$currentDate = date('Y-m-d');

$queryTotalFlights = "SELECT COUNT(*) AS total_flights 
                      FROM flights 
                      WHERE depart_date = '$currentDate'";
$queryTotalFlightsResult = mysqli_query($con, $queryTotalFlights);

if ($queryTotalFlightsResult) {
    $row = mysqli_fetch_assoc($queryTotalFlightsResult);
    $totalFlights = $row['total_flights'];
} else {
    // Handle query error
    echo "Error retrieving total flights.";
}


// Query for Total Count of Airlines
$queryAirlineCount = "SELECT COUNT(*) as total_airlines FROM airlines";
$resultAirlineCount = mysqli_query($con, $queryAirlineCount);
$rowAirlineCount = mysqli_fetch_assoc($resultAirlineCount);
$totalAirlines = $rowAirlineCount['total_airlines'];

// Query for Today's Departing Flights
$queryDeparting = "SELECT * FROM flights WHERE depart_date = '$currentDate'";
$queryDepartingResult = mysqli_query($con, $queryDeparting);

if (!$queryDepartingResult) {
    die('Query Error: ' . mysqli_error($con));
}

// Query for Today's Arrived Flights
$currentDate = date('Y-m-d');
$currentTime = date('H:i:s');

$queryArrived = "SELECT * FROM flights 
                 WHERE arrive_date = '$currentDate' 
                 AND arrive_time <= '$currentTime'";
$queryArrivedResult = mysqli_query($con, $queryArrived);


if (!$queryArrivedResult) {
    die('Query Error: ' . mysqli_error($con));
}

// Query for Flights Departed Today
$currentDate = date("Y-m-d");
$currentTime = date("H:i:s");

$queryDepartedToday = "SELECT * FROM flights 
                       WHERE depart_date = '$currentDate' 
                       AND depart_time < '$currentTime'";

$queryDepartedTodayResult = mysqli_query($con, $queryDepartedToday);

if (!$queryDepartedTodayResult) {
    die('Query Error: ' . mysqli_error($con));
}
?>

<style>
    .scrollable-container {
    max-height: 400px; 
    overflow-y: auto; 
}
</style>


<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-4">
                <div class="card-body scrollable-container">
                    <div class="text-center">
                        <div class="row">
                            <div class="col">
                                <p>Overall Passengers:</p>
                                <h3><?php echo $totalPassengers; ?></h3>
                            </div>
                            <div class="col">
                                <p>Total Flights:</p>
                                <h3><?php echo $totalFlights; ?></h3>
                            </div>
                            <div class="col">
                                <p>Available Airlines:</p>
                                <h3><?php echo $totalAirlines; ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-4">
                <div class="card-body scrollable-container">
                    <h2 class="text-center mb-4">Today's Flights</h2>
                    <table class="table table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>From</th>
                                <th>Destination</th>
                                <th>Airline Code</th>
                                <th>Depart</th>
                                <th>Arrive</th>
                                <th>Duration</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (mysqli_num_rows($queryDepartingResult) > 0) {
                                foreach ($queryDepartingResult as $items) {
                                    ?>
                                    <tr class="text-center">
                                        <td><?= $items['from'] ?></td>
                                        <td><?= $items['to'] ?></td>
                                        <td><?= $items['airlines_id'] ?></td>
                                        <td><?= $items['depart_date'] . ' ' . $items['depart_time'] ?></td>
                                        <td><?= $items['arrive_date'] . ' ' . $items['arrive_time'] ?></td>
                                        <td><?= $items['duration'] ?></td>
                                        <td>
                                            <form action="passengers.php" method="post">
                                                <input type="hidden" name="flight_id" value="<?= $items['flight_id'] ?>">
                                                <button type="submit" class="btn btn-primary btn-sm" name="delete">View</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="4">No Flights Found for Today</td>
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

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-4">
                <div class="card-body scrollable-container">
                    <h2 class="text-center mb-4">Today's Arrived Flights</h2>
                    <table class="table table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>From</th>
                                <th>Destination</th>
                                <th>Airline Code</th>
                                <th>Depart</th>
                                <th>Arrive</th>
                                <th>Duration</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (mysqli_num_rows($queryArrivedResult) > 0) {
                                foreach ($queryArrivedResult as $items) {
                                    ?>
                                    <tr class="text-center">
                                        <td><?= $items['from'] ?></td>
                                        <td><?= $items['to'] ?></td>
                                        <td><?= $items['airlines_id'] ?></td>
                                        <td><?= $items['depart_date'] . ' ' . $items['depart_time'] ?></td>
                                        <td><?= $items['arrive_date'] . ' ' . $items['arrive_time'] ?></td>
                                        <td><?= $items['duration'] ?></td>
                                        <td>
                                            <form action="passengers.php" method="post">
                                                <input type="hidden" name="flight_id" value="<?= $items['flight_id'] ?>">
                                                <button type="submit" class="btn btn-primary btn-sm" name="delete">View</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="4">No Flights Arrived Today</td>
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

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-4">
                <div class="card-body scrollable-container">
                    <h2 class="text-center mb-4">Today's Departed Flights</h2>
                    <table class="table table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>From</th>
                                <th>Destination</th>
                                <th>Airline Code</th>
                                <th>Depart</th>
                                <th>Arrive</th>
                                <th>Duration</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($queryDepartedTodayResult)) {
                                // Display each departed flight information
                                echo "<tr class='text-center'>";
                                echo "<td>" . $row['from'] . "</td>";
                                echo "<td>" . $row['to'] . "</td>";
                                echo "<td>" . $row['airlines_id'] . "</td>";
                                echo "<td>" . $row['depart_date'] . ' ' . $row['depart_time'] . "</td>";
                                echo "<td>" . $row['arrive_date'] . ' ' . $row['arrive_time'] . "</td>";
                                echo "<td>" . $row['duration'] . "</td>";
                                echo '<td>
                                <form action="passengers.php" method="post">
                                    <input type="hidden" name="flight_id" value="' . $items['flight_id'] . '">
                                    <button type="submit" class="btn btn-primary btn-sm" name="delete">View</button>
                                </form>
                              </td>';
                        
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
mysqli_close($con);
?>
