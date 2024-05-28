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
    include 'db_connect.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "SELECT MAX(UserID) AS max_id FROM User";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $max_id = $row['max_id'];
        if ($max_id) {
            $numeric_id = (int)substr($max_id, 1); // Remove 'U' and convert to int
            $new_id = 'U' . str_pad($numeric_id + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $new_id = 'U1001';
        }

        $sql = "INSERT INTO User (UserID, Name, Email, Password) VALUES ('$new_id', '$name', '$email', '$password')";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }
    ?>

    <form method="post" action="signup.php">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        <input type="submit" value="Signup">
    </form>
    <p>Already have an account?</p>
    <button onclick="window.location.href='login.php'">Log In</button>
</body>
</html>
