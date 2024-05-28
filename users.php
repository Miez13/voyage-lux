<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
</head>
<body>
<?php
include 'db_connect.php'; // Include the database connection file

$sql = "SELECT * FROM User";
$result = $conn->query($sql);

    
if ($result->num_rows > 0) {
    echo"<table border = 1>
            <tr>
                <th>USER ID</th>
                <th>NAME</th>
                <th>EMAIL</th>
                <th>PASSWORD</th>
            </tr>";
        
    while($row = $result->fetch_assoc()) {
        $formattedUserID = 'U' . str_pad($row["UserID"], 4, '0', STR_PAD_LEFT);
        echo 
            "<tr>
                <td>" . $formattedUserID . "</td>
                <td>" . $row["Name"] . "</td>
                <td>" . $row["Email"] . "</td>
                <td>" . $row["Password"] . "</td>
            </tr>";
}
echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>
    <button onclick="window.location.href='signup.php'">Sign Up</button>
    <button onclick="window.location.href='login.php'">Log In</button>
    
</body>
</html>
