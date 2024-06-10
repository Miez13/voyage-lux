<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Implement the form for editing user information
?>

<div class="profile-container">
    <form action="update_user_info.php" method="post">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" name="username" class="form-control" value="<?php echo htmlspecialchars($_SESSION['user_name']); ?>">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($_SESSION['user_email']); ?>">
        </div>
        <div class="form-group">
            <label for="picture">Profile Picture URL:</label>
            <input type="text" name="picture" class="form-control" value="<?php echo htmlspecialchars($_SESSION['user_picture']); ?>">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>


<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $picture = $_POST['picture'];

    // Update session variables
    $_SESSION['user_name'] = $username;
    $_SESSION['user_email'] = $email;
    $_SESSION['user_picture'] = $picture;

    // Redirect back to the user profile or some confirmation page
    header("Location: users.php");
    exit();
}
