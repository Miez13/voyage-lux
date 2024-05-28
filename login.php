<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<body>
    <h1>User Login</h1>
    <?php
    include 'db_connect.php';
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM User WHERE Email='$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($password === $row['Password']) {
                $_SESSION['user_id'] = $row['UserID'];
                $_SESSION['user_name'] = $row['Name'];
                header("Location: listings.php");
                exit();
            } else {
                echo "Invalid password";
            }
        } else {
            echo "No user found with this email";
        }
        $conn->close();
    }
    ?>

    <form method="post" action="login.php">
        Email: <input type="email" name="email" required><br>
        Password: <input type="password" name="password" required><br>
        <input type="submit" value="Login">
    </form>
    <br>
    <p>Didn't have one? Sign up now</p>
    <button onclick="window.location.href='signup.php'">Sign Up</button>
</body>
</html>
