<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<header class="d-flex justify-content-center">
    <div class="logo">
        <img src="image/logo.png" alt="Logo">
    </div>
    <nav>
        <ul>
            <?php
            if (isset($_SESSION['username'])) {
                echo '<li><a href="#">Welcome, ' . $_SESSION['username'] . '</a></li>';
                echo '<li><a href="index.php">Book flight</a></li>';
                echo '<li><a href="my_flights.php">My Flights</a></li>';
                echo '<li><a href="about.php">About</a></li>';
                echo '<li><a href="#">Services</a></li>';
                echo '<li><a class="signin" href="logout.php">Log out</a></li>';
            } else {
                echo '<li><a class="signin"  href="login.php">Sign in</a></li>';
                echo '<li><a href="index.php">Home</a></li>';
                echo '<li><a href="about.php">About</a></li>';
                echo '<li><a href="#">Services</a></li>';
            }
            ?>
        </ul>
    </nav> 
</header>


<div id="popupContainer" class="popup">
    <div class="popup-content">
        <span class="close" id="closePopup">&times;</span>
        <h2>Sign In</h2>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <input type="submit" value="Login">
        </form>
        <p>Don't have an account? <a href="register.php">Sign Up here</a></p> 
        <p><a href="admin/login.php">Sign in as admin</a></p> 
        
    </div>
</div>

<script src="js/script.js"></script>
