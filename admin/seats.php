<?php
    include "includes/admin-header.php";
    include "includes/admin-head.php";
?>

<div class="body">
    <h1>Add flights</h1>
    <div class="container">
        <form id="flight-form">
            <div class="input-container">
                <label for="flight-code">Flight Code:</label>
                <input type="text" id="flight-code" placeholder="Enter flight code">
            </div>

            <div class="input-container">
                <label for="from">From:</label>
                <input type="text" id="from" placeholder="Enter departure location">
            </div>

            <div class="input-container">
                <label for="to">To:</label>
                <input type="text" id="to" placeholder="Enter arrival location">
            </div>

            <div class="input-container">
                <label for="depart-time">Depart Time:</label>
                <input type="text" id="depart-time" placeholder="Enter departure time">
            </div>

            <div class="input-container">
                <label for="arrival-time">Arrival Time:</label>
                <input type="text" id="arrival-time" placeholder="Enter arrival time">
            </div>

            <div class="input-container">
                <label for="departing-date">Departing Date:</label>
                <input type="text" id="departing-date" placeholder="Enter departing date">
            </div>

            <div class="input-container">
                <button type="button" id="add-flight-button">Add Flight</button>
                <button type="button" id="delete-button">Delete</button>
            </div>
        </form>
    </div>

    <div class="tablecontainer">

    </div>
</div>
