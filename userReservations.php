<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch and display the user's reservations
?>

<div class="profile-container">
    <h3>Your Reservations</h3>
    <!-- Implement reservation display here -->
</div>
