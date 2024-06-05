<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservations</title>
</head>
<body>
    <h1>Reservations</h1>
    <button onclick="window.location.href='addReservation.php'">Make Reservation</button>
    <br><br>
    <?php
    include 'db_connect.php'; // Include the database connection file

    $sql = "SELECT * FROM Reservation";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>ReservationID</th>
                    <th>CheckInDate</th>
                    <th>CheckOutDate</th>
                    <th>CustCategory</th>
                    <th>CustPax</th>
                    <th>UserID</th>
                    <th>ListingID</th>
                    <th>InvoiceID</th>
                </tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["ReservationID"]. "</td>
                    <td>" . $row["CheckInDate"]. "</td>
                    <td>" . $row["CheckOutDate"]. "</td>
                    <td>" . $row["CustCategory"]. "</td>
                    <td>" . $row["CustPax"]. "</td>
                    <td>" . $row["UserID"]. "</td>
                    <td>" . $row["ListingID"]. "</td>
                    <td>" . $row["InvoiceID"]. "</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "No reservations found";
    }

    $conn->close();
    ?>
</body>
</html>
