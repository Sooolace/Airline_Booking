<?php
session_start();

// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";

include "includes/header.php";
include "includes/head.php";
include "includes/footer.php";

// Check if the form is submitted with the number of passengers
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['passenger'])) {
    $_SESSION['passenger_count'] = $_GET['passenger']; // Store passenger count in session
}

// Initialize selected_flight_id
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form was submitted from the Passenger Details form
    if (isset($_POST['first_name'])) {
        // Retrieve user_id from the session
        $user_id = $_SESSION['user_id'] ?? '';
        $flight_id = $_SESSION['flight_id'] ?? '';
        $price = $_SESSION['price'] ?? '';
        $class = $_SESSION['class'] ?? '';

        

        // Loop through passenger details and store them in session
        $passengerDetails = [];
        for ($i = 0; $i < count($_POST['first_name']); $i++) {
            $passengerDetails[] = [
                'first_name' => $_POST['first_name'][$i] ?? '',
                'middle_name' => $_POST['middle_name'][$i] ?? '',
                'last_name' => $_POST['last_name'][$i] ?? '',
                'phone_no' => $_POST['phone_no'][$i] ?? '',
                'email' => $_POST['email'][$i] ?? '',
            ];
        }

        // Store passenger details in the session
        $_SESSION['passenger_details'] = $passengerDetails;

        // Redirect to payment.php
        header("Location: payment.php");
        exit();
    }
}
?>
<div class="container pass_form_container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">Passenger Details</h1>
            <p class="mt-3 mb-0"><a href="enddetails.php">Go Back</a></p>

            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <?php
                $passenger_count = $_SESSION['passenger_count'] ?? 1;

                // Loop to create input fields for each passenger
                for ($i = 1; $i <= $passenger_count; $i++) {
                ?>
                <div class="border py-3 mb-5 text-center">
                    <h3>Passenger <?= $i ?></h3>
                    <div class="form-row ml-2 mr-2">
                        <div class="form-group col-md-4">
                            <label for="first_name<?= $i ?>">First name</label>
                            <input type="text" class="form-control" id="first_name<?= $i ?>" name="first_name[]" placeholder="Enter your first name" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="middle_name<?= $i ?>">Middle name</label>
                            <input type="text" class="form-control" id="middle_name<?= $i ?>" name="middle_name[]" placeholder="Enter your middle name">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="last_name<?= $i ?>">Last name</label>
                            <input type="text" class="form-control" id="last_name<?= $i ?>" name="last_name[]" placeholder="Enter your last name" required>
                        </div>
                    </div>
                    <div class="form-row ml-2 mr-2">
                        <div class="form-group col-md-6">
                            <label for="phone_no<?= $i ?>">Contact no.</label>
                            <input type="text" class="form-control" id="phone_no<?= $i ?>" name="phone_no[]" placeholder="Enter your contact number" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email<?= $i ?>">Email address</label>
                            <input type="email" class="form-control" id="email<?= $i ?>" name="email[]" placeholder="Enter your email address" required>
                            
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-rocket"></i> Proceed to Payment
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
