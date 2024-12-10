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
    <h1>Book Flights with ease</h1>
    <p>Set your flight below</p> <br>
    
    <div class="fcontainer">
    <form method="GET" action="flights_results.php">
        <div class="dropdown">
            <span>Select type of flight</span>
            <span class="arrow">▼ | </span>
            <div class="dropdown-content" id="flightTypeDropdown">
                <a href="#" onclick="showOneWayFields()">One-way</a>
                <a href="#" onclick="showRoundTripFields()">Round-trip</a>
            </div>
            <span class="from-to"> 
                <label for="passengerCount">Passenger</label>
                <input type="number" name="passenger" placeholder="Passenger" min="1" value="1">
            </span>
            <span class="from-to"> 
                <label for="selectClass">Select Class</label>
                <select id="selectClass" name="selectClass" placeholder="Select Class" required>
                    <option value="">Select Class</option>
                    <option value="Economy">Economy</option>
                    <option value="Business Class">Business Class</option>
                </select>

            </span>        
        </div>
            <div class="from-to" onsubmit="return validateSearchForm()" class="input-container" id="oneWayFields" style="display: block;">
                <label for="fromCity">From</label>
                <input type="text" id="fromCity" name="from" placeholder="From City">
                <label for="toCity">To</label>
                <input type="text" id="toCity" name="to" placeholder="To City">
                <label for="depart_date">Depart Date</label>
                <input type="date" id="depart_date" name="depart_date" placeholder="Depart Date">
                <button type="submit" class="btn btn-primary" name="searchFlights">Search Flights</button>
        </div>
    </form>   
    <form method="GET" action="flights_results.php"> 
            <div class="from-to" onsubmit="return validateSearchForm()" class="input-container" id="roundTripFields" style="display: none;">
            <label for="fromCityRound">From</label>
                <input type="text" id="fromCityRound" name="from" placeholder="From City">
                <label for="toCityRound">To</label>
                <input type="text" id="toCityRound" name="to" placeholder="To City">
                <label for="departDateRound">Depart Date</label>
                <input type="date" id="departDateRound" name="depart_date" placeholder="Depart Date">
                <label for="returnDateRound">Return Date</label>
                <input type="date" id="returnDateRound" name="return_date" placeholder="Return Date">
                <button type="submit" class="btn btn-primary" name="searchFlights">Search Flights</button>
            </div>
            </form>           
</div>

