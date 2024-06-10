<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}
?>

<div class="profile-container">
    <img src="<?php echo htmlspecialchars($_SESSION['user_picture']); ?>" alt="Profile Picture">
    <p><strong>User ID:</strong> <?php echo htmlspecialchars($_SESSION['user_id']); ?></p>
    <p><strong>Username:</strong> <?php echo htmlspecialchars($_SESSION['user_name']); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION['user_email']); ?></p>
</div>
