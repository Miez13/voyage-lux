<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    include 'db_connect.php'; // Include the database connection file

    $sql = "SELECT * FROM Review";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "ReviewID: " . $row["ReviewID"]. " - Rating: " . $row["Rating"]. " - Comment: " . $row["Comment"]. " - UserID: " . $row["UserID"]. " - ListingID: " . $row["ListingID"]. "<br>";
        }
    } else {
        echo "0 results";
    }

    $conn->close();
    ?>

</body>
</html>
