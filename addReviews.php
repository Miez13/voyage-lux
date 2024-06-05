<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Review</title>
</head>
<body>
<h1>Add New Review</h1>
    <?php
        include 'db_connect.php';
        session_start();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $rating = $_POST['rating'];
            $comment = $_POST['comment'];
            $listingID = $_POST['listingID']; // Assuming this is passed in the form
            $userID = $_SESSION['user_id']; 

            // Generate new ReviewID
            $sql_max_id = "SELECT MAX(CAST(SUBSTRING_INDEX(ReviewID, 'R', -1) AS UNSIGNED)) AS max_id FROM Review";
            $result_max_id = $conn->query($sql_max_id);
            $row_max_id = $result_max_id->fetch_assoc();
            $max_id = $row_max_id['max_id'];
            $new_id = 'R' . str_pad($max_id + 1, 4, '0', STR_PAD_LEFT);

            // Insert review into database
            $sql = "INSERT INTO Review (ReviewID, Rating, Comment, UserID, ListingID) VALUES ('$new_id', '$rating', '$comment', '$userID', '$listingID')";

            if ($conn->query($sql) === TRUE) {
                echo "New review created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    ?>
    <form method="post" action="addReviews.php">
        <label for="listingID">Listing ID:</label>
        <input type="text" id="listingID" name="listingID" placeholder="L0001" required><br>
        <label for="rating">Rating:</label>
        <input type="number" id="rating" name="rating" placeholder="1 - 5" required><br>
        <label for="comment">Comment:</label>
        <input type="text" id="comment" name="comment" placeholder="Everything was superb" required><br>
        <input type="submit" value="Add Review">
    </form>
    <br>
    <button onclick="window.location.href='listings.php'">Back to Listing</button>
</body>
</html>
