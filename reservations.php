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

    $sql = "SELECT * FROM Reservation";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "ReservationID: " . $row["ReservationID"]. " - CheckInDate: " . $row["CheckInDate"]. " - CheckOutDate: " . $row["CheckOutDate"]. " - CustCategory: " . $row["CustCategory"]. " - CustPax: " . $row["CustPax"]. " - UserID: " . $row["UserID"]. " - ListingID: " . $row["ListingID"]. " - InvoiceID: " . $row["InvoiceID"]. "<br>";
        }
    } else {
        echo "0 results";
    }

    $conn->close();
    ?>
</body>
</html>
