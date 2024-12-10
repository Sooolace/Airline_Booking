<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['selectedClass'])) {

    $_SESSION['selected_class'] = $_POST['selectedClass'];

    echo json_encode(['status' => 'success', 'message' => 'Selected class updated successfully']);
} else {

    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
