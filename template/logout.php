<?php
include("../database/conn.php");
session_start();

// Make sure the session contains the user data
if (isset($_SESSION['user'])) {
    $userId = $_SESSION['user']['user_id'];

    // Update the status and last active timestamp
    $stmt = $conn->prepare("UPDATE user SET status = 'Inactive', last_active = NOW() WHERE user_id = ?");
    $stmt->execute([$userId]);
}

// Destroy the session and redirect to login
session_destroy();
header("Location: ../landingPage/login.php");
exit();
?>
