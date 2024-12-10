<header class="d-flex justify-content-center">
<?php if (isset($_SESSION['username'])) : ?>
    <nav>
        <ul>
            <li><a href="admin.php">Home</a></li>
            <li><a href="./allflights.php">View Flights</a></li>
            <li><a href="flights.php">Add Flights</a></li>
            <!-- <li><a href="aircraft.php">Add Aircraft</a></li> -->
            <li><a href="airlines.php">Manage Airlines</a></li>
            <li><a href="cities.php">View Cities</a></li>
            <li><a class="signin" href="logout.php">Log out</a></li>
        </ul>
    </nav>
<?php else : ?>
    <div class="admin-login-panel" style="font-weight: bold; font-size: 24px;">
        <p>Admin Login</p>

    </div>
<?php endif; ?>
    </header>