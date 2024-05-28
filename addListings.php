<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Listing</title>
</head>
<body>
    <h1>Add New Listing</h1>
    <?php
        include 'db_connect.php';
        session_start();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $location = $_POST['location'];
            $price = $_POST['price'];
            $userID = $_SESSION['user_id']; 

            $sql_max_id = "SELECT MAX(CAST(SUBSTRING_INDEX(ListingID, 'L', -1) AS UNSIGNED)) AS max_id FROM Listing";
            $result_max_id = $conn->query($sql_max_id);
            $row_max_id = $result_max_id->fetch_assoc();
            $max_id = $row_max_id['max_id'];
            $new_id = 'L' . str_pad($max_id + 1, 4, '0', STR_PAD_LEFT);


            $sql = "INSERT INTO Listing (ListingID, Title, Description, Location, Price, UserID) VALUES ('$new_id', '$title', '$description', '$location', '$price', '$userID')";

            if ($conn->query($sql) === TRUE) {
                echo "New listing created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

    ?>
    <form method="post" action="addListings.php">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" placeholder="Cendana Homestay" required><br>
        <label for="description">Description:</label>
        <input type="text" id="description" name="description" placeholder="2 room homestay" required><br>
        <label for="location">Location:</label>
        <input type="text" id="location" name="location" placeholder="Kota Bharu, Kelantan" required><br>
        <label for="price">Price:</label>
        <input type="number" id="price" name="price" placeholder="00.00" required><br>
        <input type="submit" value="Add Listing">
    </form>
    <br>
    <button onclick="window.location.href='listings.php'">Back to Listing</button>
</body>
</html>
