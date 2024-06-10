<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>
</head>
<body>
    <h1>User Signup</h1>
    <?php
session_start();
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_repeat = $_POST['password_repeat'];

    if ($password !== $password_repeat) {
        echo "Passwords do not match.";
        exit();
    }

    // Generate a unique UserID, e.g., U1003
    $sql = "SELECT MAX(UserID) as max_id FROM user";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $max_id = $row['max_id'];
    $new_id = 'U' . str_pad((int)substr($max_id, 1) + 1, 4, '0', STR_PAD_LEFT);

    $sql = "INSERT INTO user (UserID, Name, Email, Password) VALUES ('$new_id', '$name', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "New user registered successfully. Please log in.";
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<body>
    <h1>User Login</h1>
    <div class="login-wrap">
        <div class="login-html">
            <input id="tab-1" type="radio" name="tab" class="sign-in" checked>
            <label for="tab-1" class="tab">Sign In</label>
            <input id="tab-2" type="radio" name="tab" class="sign-up">
            <label for="tab-2" class="tab">Sign Up</label>
            <div class="login-form">
                <form method="post" action="login.php">
                    <div class="sign-in-htm">
                        <div class="group">
                            <label for="email_or_name" class="label">Email or Username</label>
                            <input id="email_or_name" name="email_or_name" type="text" class="input" required>
                        </div>
                        <div class="group">
                            <label for="password" class="label">Password</label>
                            <input id="password" name="password" type="password" class="input" data-type="password" required>
                        </div>
                        <div class="group">
                            <input type="submit" class="button" value="Sign In">
                        </div>
                        <div class="hr"></div>
                        <div class="foot-lnk">
                            <a href="#forgot">Forgot Password?</a>
                        </div>
                    </div>
                </form>
                <div class="sign-up-htm">
                    <form method="post" action="signup.php">
                        <div class="group">
                            <label for="name" class="label">Username</label>
                            <input id="name" name="name" type="text" class="input" required>
                        </div>
                        <div class="group">
                            <label for="email" class="label">Email Address</label>
                            <input id="email" name="email" type="email" class="input" required>
                        </div>
                        <div class="group">
                            <label for="password" class="label">Password</label>
                            <input id="password" name="password" type="password" class="input" data-type="password" required>
                        </div>
                        <div class="group">
                            <label for="password_repeat" class="label">Repeat Password</label>
                            <input id="password_repeat" name="password_repeat" type="password" class="input" data-type="password" required>
                        </div>
                        <div class="group">
                            <input type="submit" class="button" value="Sign Up">
                        </div>
                        <div class="hr"></div>
                        <div class="foot-lnk">
                            <label for="tab-1">Already Member?</label>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

</html>
