<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews</title>
</head>
<body>
    <h1>Reviews</h1>
    <button onclick="window.location.href='reviews.php?view=1'">View Reviews</button>
    <button onclick="window.location.href='addReviews.php'">Add Review</button>
    <br><br>
    <?php
    include 'db_connect.php';

    if (isset($_GET['view']) && $_GET['view'] == 1) {
        $sql = "SELECT * FROM Review";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table border='1'>
                    <tr>
                        <th>ReviewID</th>
                        <th>Rating</th>
                        <th>Comment</th>
                        <th>UserID</th>
                        <th>ListingID</th>
                    </tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["ReviewID"]. "</td>
                        <td>" . $row["Rating"]. "</td>
                        <td>" . $row["Comment"]. "</td>
                        <td>" . $row["UserID"]. "</td>
                        <td>" . $row["ListingID"]. "</td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "No reviews found";
        }
    }

    $conn->close();
    ?>
<br>
<button onclick="window.location.href='Listings.php'">Back To Listing</button>

</body>
</html>
