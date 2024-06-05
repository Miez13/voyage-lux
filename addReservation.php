<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Reservation</title>
</head>
<body>
<h1>Add New Reservation</h1>
    <?php
        include 'db_connect.php';
        session_start();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $checkInDate = $_POST['checkInDate'];
            $checkOutDate = $_POST['checkOutDate'];
            $custCategory = $_POST['custCategory'];
            $custPax = $_POST['custPax'];
            $listingID = $_POST['listingID'];
            $userID = $_SESSION['user_id']; // Assuming user_id is stored in the session

            // Generate new ReservationID
            $sql_max_id = "SELECT MAX(CAST(SUBSTRING_INDEX(ReservationID, 'R', -1) AS UNSIGNED)) AS max_id FROM Reservation";
            $result_max_id = $conn->query($sql_max_id);
            $row_max_id = $result_max_id->fetch_assoc();
            $max_id = $row_max_id['max_id'];
            $new_id = 'R' . str_pad($max_id + 1, 4, '0', STR_PAD_LEFT);

            // Insert reservation into database
            $sql = "INSERT INTO Reservation (ReservationID, CheckInDate, CheckOutDate, CustCategory, CustPax, UserID, ListingID, InvoiceID) 
                    VALUES ('$new_id', '$checkInDate', '$checkOutDate', '$custCategory', '$custPax', '$userID', '$listingID', NULL)";

            if ($conn->query($sql) === TRUE) {
                echo "New reservation created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    ?>
    <form method="post" action="addReservation.php">
        <label for="checkInDate">Check-In Date:</label>
        <input type="date" id="checkInDate" name="checkInDate" required><br>
        <label for="checkOutDate">Check-Out Date:</label>
        <input type="date" id="checkOutDate" name="checkOutDate" required><br>
        <label for="custCategory">Customer Category:</label>
        <input type="text" id="custCategory" name="custCategory" placeholder="e.g., Family, Couple" required><br>
        <label for="custPax">Number of Guests:</label>
        <input type="number" id="custPax" name="custPax" placeholder="e.g., 2" required><br>
        <label for="listingID">Listing ID:</label>
        <input type="text" id="listingID" name="listingID" placeholder="L0001" required><br>
        <input type="submit" value="Make Reservation">
    </form>
    <br>
    <button onclick="window.location.href='listings.php'">Back to Listings</button>
</body>
</html>
