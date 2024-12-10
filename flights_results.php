<?php
session_start();

// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";

$isLoggedIn = isset($_SESSION['user_id']) && isset($_SESSION['username']);

// Set default passenger count if not already set
if (!isset($_SESSION['passenger_count'])) {
    $_SESSION['passenger_count'] = 1;
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['selectClass'])) {
    $_SESSION['class'] = $_GET['selectClass'];
    if ($_GET['selectClass'] === 'Economy') {
        $_SESSION['selected_class_details'] = 'Economy class details...'; 
    } elseif ($_GET['selectClass'] === 'Business Class') {
        $_SESSION['selected_class_details'] = 'Business class details...';
    }

}

// Update passenger count if provided via GET (e.g., from a search form)
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['passenger'])) {
    $_SESSION['passenger_count'] = $_GET['passenger'];
}

include "includes/header.php";
include "includes/head.php";
include "includes/footer.php";

// Handle storing price, flight_id, and passenger_count in session when "Buy" button is clicked
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['buy_flight'])) {
    // Check if these values are available in the POST data before updating session
    if (isset($_POST['price'], $_POST['flight_id'])) {
        $_SESSION['price'] = $_POST['price'];
        $_SESSION['flight_id'] = $_POST['flight_id'];
    }

    // Redirect to pass_form.php to proceed with passenger details
    header("Location: pass_form.php");
    exit();
}
?>
<div class="body">
    <div class="container1">
    <h2>Available Flights</h2>
    <div class="row">
        <div class="col-md-7"></div>
        <div class="col-md-12">
            <div class="card mt-4">
                <div class="card-body" >
                    <table class="table table-bordered">
                        <thead>
                            <tr class="text-center" >
                               <th style="display: none;">ID</th>
                                <th>From</th>
                                <th>Destination</th>
                                <th>Airline</th>
                                <th>Depart</th>
                                <th>Arrive</th>
                                <th>Price</th>
                                <th>Buy</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $con = mysqli_connect('localhost', 'root', '', 'airline_booking_system');

                            if (isset($_GET['searchFlights'])) {
                                $from = $_GET['from'];
                                $to = $_GET['to'];
                                $depart_date = $_GET['depart_date'];
                                $current_date = date('Y-m-d H:i:s'); // Get the current date
                            
                                $query = "SELECT * FROM flights 
                                          WHERE `from` = '$from' 
                                          AND `to` = '$to' 
                                          AND `depart_date` >= '$current_date'";
                            } else {
                                $current_date = date('Y-m-d H:i:s'); // Get the current date
                            
                                $query = "SELECT * FROM flights WHERE `depart_date` >= '$current_date'";
                            }
                            

                            $query_run = mysqli_query($con, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                foreach ($query_run as $items) {
                                    ?>
                                <tr class="text-center">
                                    <td style="display: none;"><?= $items['flight_id'] ?></td>
                                    <td><?= $items['from'] ?></td>
                                    <td><?= $items['to'] ?></td>
                                    <td><?= $items['airlines_id'] ?></td>
                                    <td><?= $items['depart_date'] . ' ' . $items['depart_time'] ?></td>
                                    <td><?= $items['arrive_date'] . ' ' . $items['arrive_time'] ?></td>
                                    <td><?= $items['price'] ?></td>
                                    <td>
                                        <?php if ($isLoggedIn) { ?>
                                            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                                <input type="hidden" name="price" value="<?= $items['price'] ?>">
                                                <input type="hidden" name="flight_id" value="<?= $items['flight_id'] ?>">
                                                <input type="hidden" name="passenger_count" value="<?= $_SESSION['passenger_count'] ?>">
                                                <button type="submit" class="btn btn-primary" name="buy_flight">Buy</button>
                                            </form>
                                        <?php } else { ?>
                                            <p>Please <a href="login.php">log in</a> to proceed</p>
                                        <?php } ?>
                                    </td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="4">No Flight Found</td>
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
