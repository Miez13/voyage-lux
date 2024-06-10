<?php
include 'db_connect.php';
session_start();
$login_message = '';
$signup_message = '';

// Logout logic
if (isset($_POST['logout'])) {
    session_unset(); // Unset all session variables
    session_destroy(); // Destroy the session
    header("Location: login.php"); // Redirect to login page
    exit();
}

// Login logic
if (isset($_POST['login'])) {
    $email_or_name = trim($_POST['email_or_name']);
    $password = trim($_POST['password']);

    if (empty($email_or_name) || empty($password)) {
        $login_message = "Please fill in both fields.";
    } else {
        $sql = "SELECT * FROM User WHERE Email=? OR Name=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $email_or_name, $email_or_name);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($password === $row['Password']) {
                $_SESSION['user_id'] = $row['UserID'];
                $_SESSION['user_name'] = $row['Name'];
                $_SESSION['user_email'] = $row['Email'];
                $_SESSION['user_picture'] = $row['ProfilePicture'];
                header("Location: index.php");
                exit();
            } else {
                $login_message = "Invalid password.";
            }
        } else {
            $login_message = "No user found with this email or username.";
        }
        $stmt->close();
    }
}

    // Signup logic
    if (isset($_POST['signup'])) {
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $password_repeat = trim($_POST['password_repeat']);
        $profile_picture = $_FILES['profile_picture'];

        if (empty($name) || empty($email) || empty($password) || empty($password_repeat)) {
            $signup_message = "Please fill in all fields.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $signup_message = "Invalid email format.";
        } elseif ($password !== $password_repeat) {
            $signup_message = "Passwords do not match.";
        } elseif ($profile_picture['error'] != 0) {
            $signup_message = "Error uploading profile picture.";
        } else {
            $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
            $file_extension = pathinfo($profile_picture['name'], PATHINFO_EXTENSION);

            if (!in_array(strtolower($file_extension), $allowed_extensions)) {
                $signup_message = "Invalid file type for profile picture.";
            } else {
                $profile_picture_path = 'uploads/' . basename($profile_picture['name']);
                move_uploaded_file($profile_picture['tmp_name'], $profile_picture_path);

                // Fetch the highest UserID and increment it
                $sql = "SELECT MAX(CAST(SUBSTRING(UserID, 2) AS UNSIGNED)) AS max_id FROM User";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                $new_user_id = 'U' . str_pad(($row['max_id'] + 1), 4, '0', STR_PAD_LEFT);

                // Insert user data into the database without hashing the password
                $sql = "INSERT INTO User (UserID, Name, Email, Password, ProfilePicture) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssss", $new_user_id, $name, $email, $password, $profile_picture_path);

                if ($stmt->execute()) {
                    header("Location: login.php");
                    exit();
                } else {
                    $signup_message = "Error creating account. Please try again.";
                }
                $stmt->close();
            }
        }
    }
    $conn->close();

    ?>
    
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <!-- Header -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                    <a href="index.php" class="logo">
                            <span class="logo-main">VoyageLux</span> 
                            <span class="logo-sub">by Zen Corp</span>
                            <img src="assets/images/logoVL2.1.png" height="35" padding-top:10>
                        </a>
                        <ul class="nav">
                            <li><a href="index.php">Home</a></li>
                            <li><a href="listings.php">Listings</a></li>
                            <li><a href="testimonials.php">Reviews</a></li>
                            <li><a href="about.php">About Us</a></li>
                            <li><a href="contact.php">Contact</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- End Header -->
   
<style>

    .header-area {
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            z-index: 10;
        }
        
        .header-area .main-nav .nav {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 0;
            text-align: right;
        }

        .header-area .main-nav .nav li {
            margin-left: 0.001px;
        }

        .header-area .main-nav .nav li a {
            color: #000; /* Change navigation button color to black */
            text-transform: uppercase;
            font-weight: 600;
            padding: 10px 15px;
            transition: all 0.3s ease;
        }

        .header-area .main-nav .nav li a:hover {
            color: #007bff;
        }

        .header-area .main-nav .logo {
            float: left;
            display: block;
            margin-right: 10;
            color: #000;
            text-transform: uppercase;
            font-size: 24px;
            font-weight: 700;
        }

        .header-area .main-nav .logo .logo-main {
            margin-right: 10px;
            margin-left: 80px;
            color: #000; 
        }

        .header-area .main-nav .logo .logo-sub {

            color: #777;
        }
        .header-area .main-nav .menu-trigger {
            display: none;
            cursor: pointer;
        }

        body {
            margin: 0;
            color: #6a6f8c;
            background: #c8c8c8;
            font: 600 16px/18px 'Poppins', sans-serif;
        }

        *,
        :after,
        :before {
            box-sizing: border-box;
        }

        .clearfix:after,
        .clearfix:before {
            content: '';
            display: table;
        }

        .clearfix:after {
            clear: both;
            display: block;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .login-wrap {
            width: 100%;
            margin-top: 2.1cm;
            max-width: 525px;
            min-height: 670px;
            position: relative;
            background: url(assets/images/21_Vertical_House.jpg) no-repeat center;
            box-shadow: 0 12px 15px 0 rgba(0, 0, 0, .24), 0 17px 50px 0 rgba(0, 0, 0, .19);
        }

        .login-html {
            width: 100%;
            height: 100%;
            position: absolute;
            padding: 90px 70px 50px 70px;
            background: rgba(23, 23, 23, .9);
        }

        .login-html .sign-in-htm,
        .login-html .sign-up-htm {
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            position: absolute;
            transform: rotateY(180deg);
            backface-visibility: hidden;
            transition: all .4s linear;
        }

        .login-html .sign-in,
        .login-html .sign-up,
        .login-form .group .check {
            display: none;
        }

        .login-html .tab,
        .login-form .group .label,
        .login-form .group .button {
            text-transform: uppercase;
        }

        .login-html .tab {
            font-size: 22px;
            margin-right: 15px;
            padding-bottom: 5px;
            margin: 0 15px 10px 0;
            display: inline-block;
            border-bottom: 2px solid transparent;
        }

        .login-html .sign-in:checked+.tab,
        .login-html .sign-up:checked+.tab {
            color: #fff;
            border-color: #1161ee;
        }

        .login-form {
            min-height: 345px;
            position: relative;
            perspective: 1000px;
            transform-style: preserve-3d;
        }

        .login-form .group {
            margin-bottom: 15px;
        }

        .login-form .group .label,
        .login-form .group .input,
        .login-form .group .button {
            width: 100%;
            color: #fff;
            display: block;
        }

        .login-form .group .input,
        .login-form .group .button {
            border: none;
            padding: 15px 20px;
            border-radius: 25px;
            background: rgba(255, 255, 255, .1);
        }

        .login-form .group input[data-type="password"] {
            text-security: circle;
            -webkit-text-security: circle;
        }

        .login-form .group .label {
            color: #aaa;
            font-size: 12px;
        }

        .login-form .group .button {
            background: #1161ee;
        }

        .login-html .sign-in:checked+.tab+.sign-up+.tab+.login-form .sign-in-htm {
            transform: rotate(0);
        }

        .login-html .sign-up:checked+.tab+.login-form .sign-up-htm {
            transform: rotate(0);
        }

        .hr {
            height: 2px;
            margin: 60px 0 50px 0;
            background: rgba(255, 255, 255, .2);
        }

        .foot-lnk {
            text-align: center;
        }
</style>

<div class="login-wrap">
        <div class="login-html">
            <input id="tab-1" type="radio" name="tab" class="sign-in" checked>
            <label for="tab-1" class="tab" onclick="showSignIn()">Sign In</label>
            <input id="tab-2" type="radio" name="tab" class="sign-up">
            <label for="tab-2" class="tab" onclick="showSignUp()">Sign Up</label>
            <div class="login-form">
                <!-- Sign-in form -->
                <form action="login.php" method="post" id="signin-form">
                    <div class="group">
                        <label for="email_or_name" class="label">Email or Username</label>
                        <input id="email_or_name" name="email_or_name" type="text" class="input" required>
                    </div>
                    <div class="group">
                        <label for="password" class="label">Password</label>
                        <input id="password" name="password" type="password" class="input" data-type="password" required>
                    </div>
                    <div class="group">
                        <input type="hidden" name="login" value="1">
                        <input type="submit" class="button" value="Sign In">
                    </div>
                    <div class="group">
                        <?php if (!empty($login_message)) : ?>
                            <p class="error"><?php echo $login_message; ?></p>
                        <?php endif; ?>
                    </div>
                </form>

                <!-- Sign-up form -->
                <form action="login.php" method="post" enctype="multipart/form-data" id="signup-form" style="display: none;">
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
                        <label for="profile_picture" class="label">Profile Picture</label>
                        <input id="profile_picture" name="profile_picture" type="file" class="input" accept="image/*">
                    </div>
                    <div class="group">
                        <input type="hidden" name="signup" value="1">
                        <input type="submit" class="button" value="Sign Up">
                    </div>
                    <div class="group">
                        <?php if (!empty($signup_message)) : ?>
                            <p class="error"><?php echo $signup_message; ?></p>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function showSignIn() {
            document.getElementById('signin-form').style.display = 'block';
            document.getElementById('signup-form').style.display = 'none';
        }

        function showSignUp() {
            document.getElementById('signin-form').style.display = 'none';
            document.getElementById('signup-form').style.display = 'block';
        }
    </script>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p>
                        Copyright © 2024 Zen Corporation</a>
                    </p>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>