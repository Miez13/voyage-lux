<?php
// editListing.php

include 'db_connect.php'; // Include your database connection file
session_start(); // Start the session if not already started

// Initialize variables
$title = $description = $location = $price = $listingPicture = "";
$listingID = "";

// Check if listing ID is provided (for updating)
if (isset($_GET['id'])) {
    $listingID = $_GET['id'];
    // Fetch existing listing data
    $sql = "SELECT * FROM Listing WHERE ListingID = '$listingID'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $title = $row['Title'];
        $description = $row['Description'];
        $location = $row['Location'];
        $price = $row['Price'];
        $listingPicture = $row['ListingPicture'];
    } else {
        echo "Listing not found.";
        exit();
    }
} else {
    echo "No listing ID provided.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['listingID'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $price = $_POST['price'];
    $listingPicture = $_POST['listingPicture'];
    $userID = $_SESSION['user_id'];
    $listingID = $_POST['listingID'];

    // Update existing listing
    $sql = "UPDATE Listing SET Title='$title', Description='$description', Location='$location', Price='$price', ListingPicture='$listingPicture', UserID='$userID' WHERE ListingID='$listingID'";

    if ($conn->query($sql) === TRUE) {
        echo "Listing updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Listing</title>
</head>
<body>
    <h1>Edit Listing</h1>
    <form method="post" action="updateListingInfo.php?id=<?php echo $listingID; ?>">
        <input type="hidden" name="listingID" value="<?php echo $listingID; ?>">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="<?php echo $title; ?>" placeholder="Cendana Homestay" required><br>
        <label for="description">Description:</label>
        <input type="text" id="description" name="description" value="<?php echo $description; ?>" placeholder="2 room homestay" required><br>
        <label for="location">Location:</label>
        <input type="text" id="location" name="location" value="<?php echo $location; ?>" placeholder="Bali" required><br>
        <label for="price">Price:</label>
        <input type="number" id="price" name="price" value="<?php echo $price; ?>" placeholder="100" required><br>
        <label for="listingPicture">Listing Picture URL:</label>
        <input type="file" id="listingPicture" name="listingPicture" value="<?php echo $listingPicture; ?>" placeholder="http://example.com/image.jpg" required><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
