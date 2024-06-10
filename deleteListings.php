<?php
// Include database connection
include 'db_connect.php';

// Initialize $listing_id
$listing_id = "";

// Check if ListingID is set and not empty
if(isset($_GET['id']) && !empty($_GET['id'])) {
    // Sanitize input to prevent SQL injection
    $listing_id = mysqli_real_escape_string($conn, $_GET['id']);
    
    // Retrieve listing information for confirmation message
    $sql_select = "SELECT * FROM listing WHERE ListingID = '$listing_id'";
    $result = $conn->query($sql_select);
    $listing = $result->fetch_assoc();
} else {
    // If ListingID is not set or empty, redirect back to userListings.php
    header("Location: userListings.php");
    exit();
}

// Check if the deletion has been confirmed
if(isset($_POST['confirm_delete'])) {
    // Prepare SQL query to delete listing
    $sql_delete = "DELETE FROM listing WHERE ListingID = '$listing_id'";
    
    // Execute query
    if ($conn->query($sql_delete) === TRUE) {
        // Redirect back to userListings.php after successful deletion
        header("Location: userListings.php");
        exit();
    } else {
        // Error handling if deletion fails
        echo "Error deleting record: " . $conn->error;
    }
}

// Close database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Listing</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        /* Add your custom CSS styles here */
    </style>
</head>
<body>

<!-- Delete Listing Modal -->
<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Delete Listing</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete the listing with ID: <?php echo $listing['ListingID']; ?> and title: <?php echo $listing['Title']; ?>?</p>
            </div>
            <div class="modal-footer">
                <form method="post" action="">
                    <input type="submit" name="confirm_delete" value="Yes" class="btn btn-danger">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Button to trigger delete modal -->
<button type="button" class="btn btn-danger" onclick="openDeleteModal()">Delete Listing</button>

<!-- JavaScript to trigger delete modal -->
<script>
    function openDeleteModal() {
        $('#confirmationModal').modal('show');
    }
</script>

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Bootstrap JS -->
<script src="assets/js/bootstrap.min.js"></script>

</body>
</html>
