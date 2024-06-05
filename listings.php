<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listings</title>
</head>
<body>
    <h1>Listings</h1>
    <button onclick="window.location.href='listings.php?view=1'">View Listings</button>
    <button onclick="window.location.href='addListings.php'">Add Listing</button>
    <button onclick="window.location.href='reviews.php'">View Reviews</button>
    <button onclick="window.location.href='reservations.php'">Make Reservation</button>
    <br><br>
    <?php
    include 'db_connect.php';

    if (isset($_GET['view']) && $_GET['view'] == 1) {
        $sql = "SELECT * FROM Listing";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table border='1'>
                    <tr>
                        <th>ListingID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Location</th>
                        <th>Price</th>
                    </tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["ListingID"]. "</td>
                        <td>" . $row["Title"]. "</td>
                        <td>" . $row["Description"]. "</td>
                        <td>" . $row["Location"]. "</td>
                        <td>" . $row["Price"]. "</td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }
    }

    $conn->close();
    ?>
    <br>
    <button onclick="window.location.href='reservations.php'">Make Reservation</button>
</body>
</html>
