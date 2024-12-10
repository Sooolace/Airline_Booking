<?php
session_start();
include "connection.php";

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['username'], $_POST['password'])) {

    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $username = validate($_POST['username']);
    $password = validate($_POST['password']);

    if (empty($username)) {
        header("Location: login.php?error=User Name is required");
        exit();
    } else if (empty($password)) {
        header("Location: login.php?error=Password is required");
        exit();
    } else {
        $sql = "SELECT * FROM users WHERE username=? LIMIT 1";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($result && $row = mysqli_fetch_assoc($result)) {
                // Debugging statement - Remove in production
                echo "Retrieved hashed password: " . $row['password'];

                if (password_verify($password, $row['password'])) {
                    echo "Login successful!";
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['user_id'] = $row['user_id'];
                    header("Location: index.php");
                    exit();
                } else {
                    echo "Password verification failed!";
                    header("Location: login.php?error=Incorrect User name or password");
                    exit();
                }
            } else {
                echo "User not found!";
                header("Location: login.php?error=Incorrect User name or password");
                exit();
            }
        } else {
            echo "Statement preparation error: " . mysqli_error($conn);
            die("Statement preparation error: " . mysqli_error($conn));
        }
    }
} else {
    header("Location: login.php");
    exit();
}

?>
