<?php
include 'db_connect.php';

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Check if listing_id is set in the URL
if (isset($_GET["id"])) {
  $listingID = $_GET["id"];

  // Prepare and execute the SQL statement to fetch the listing details
  $stmt = $conn->prepare("SELECT * FROM Listing WHERE ListingID = ?");
  $stmt->bind_param("s", $listingID);
  $stmt->execute();
  $result = $stmt->get_result();

  // Check if a result is returned
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $listing_title = $row["Title"];
    $description = $row["Description"];
    $price = $row["Price"];
  } else {
    $listing_title = "Listing not found";
    $description = "Description not found";
    $price = "Price not found";
  }

  $stmt->close();
} else {
  $listing_title = "No listing ID provided";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
    <title>VoyageLux Homestay Reservation Website</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div id="js-preloader" class="js-preloader">
  <div class="preloader-inner">
    <span class="dot"></span>
    <div class="dots">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>
</div>

<header class="header-area header-sticky">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <nav class="main-nav">
          <a href="index.php" class="logo">
            VoyageLux <span>by Zen Corp</span>
            <img src="./assets/images/logoVL2.1.png" alt="logo Image" class="img-logo">
          </a>
          <ul class="nav">
            <li><a href="index.php">Home</a></li>
            <li><a href="listings.php">Listings</a></li>
            <li><a href="testimonials.php">Reviews</a></li>
            <li class="dropdown">
              <a class="dropdown-toggle active" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">About</a>
              <div class="dropdown-menu">
                <a href="about.php">About Us</a>
                <a href="contact.php">Contact</a>
              </div>
            </li>
            <?php if (isset($_SESSION['user_id'])): ?>
              <li>
                <a href="#" onclick="document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" action="login.php" method="post" style="display: none;">
                  <input type="hidden" name="logout" value="1">
                </form>
              </li>
              <li>
                <a href="#" class="profile-icon" data-toggle="modal" data-target="#profileModal">
                  <i class="fa fa-user"></i> <?php echo $_SESSION['user_name']; ?>
                </a>
              </li>
            <?php else: ?>
              <li><a href="login.php">Login</a></li>
            <?php endif; ?>
          </ul>
          <a class="menu-trigger">
            <span>Menu</span>
          </a>
        </nav>
      </div>
    </div>
  </div>
</header>

<div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="profileModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="profileModalLabel">Profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p><strong>User ID:</strong> <?php echo $_SESSION['user_id']; ?></p>
        <p><strong>Username:</strong> <?php echo $_SESSION['user_name']; ?></p>
        <p><strong>Email:</strong> <?php echo $_SESSION['user_email']; ?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="users.php" class="btn btn-primary">Display More</a>
      </div>
    </div>
  </div>
</div>

<section class="section section-bg" id="call-to-action" style="background-image: url(assets/images/banner-image-1-1920x500.jpg)">
  <div class="container">
    <div class="row">
      <div class="col-lg-10 offset-lg-1">
        <div class="cta-content">
          <br>
          <br>
          <h2><?php echo $listing_title; ?></h2>
          <br>
          <div class="main-button">
            <a href="#" data-toggle="modal" data-target="#exampleModal">Enquiry</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section" id="trainers">
  <div class="container">
    <br>
    <br>

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img class="d-block w-100" src="assets/images/rumah/product-1-720x480.jpg" height="450" width="450" alt="First slide">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="assets/images/rumah/dlm rumah 1.jpg" height="450" width="450" alt="Second slide">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="assets/images/rumah/kolam 1.jpg" height="450" width="450" alt="Third slide">
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
    
    <br>
    <br>

    <div class="row" id="tabs">
      <div class="col-lg-4">
        <ul>
          <li><a href='#tabs-1'><i class="fa fa-star"></i> Accommodities</a></li>
          <li><a href='#tabs-2'><i class="fa fa-info-circle"></i> Description</a></li>
          <li><a href='#tabs-3'><i class="fa fa-plus-circle"></i> Availability &amp; Prices</a></li>
          <li><a href='#tabs-5'><i class="fa fa-phone"></i> Contact Details</a></li>
          <li><a href='#tabs-6'><i class="fa fa-comments"></i> Reviews</a></li>
        </ul>
      </div>
      <div class="col-lg-8">
        <section class='tabs-content' style="width: 100%;">
          <article id='tabs-1'>
            <h4>Accommodities</h4>
            <p>Feature: Swimming pool, Parking area, Barbecue set, Televisyen, Aircond, Refrigerator</p>
          </article>
          <article id='tabs-2'>
            <h4>Description</h4>
            <p><?php echo $description; ?></p>
          </article>
          <article id='tabs-3'>
            <h4>Availability &amp; Prices</h4>
            <p><?php echo $price; ?></p>
          </article>
          <article id='tabs-5'>
            <h4>Contact Details</h4>
            <p><span>Name</span><br>Desa Rahmat <br><br><span>Phone</span><br>012-3456789 <br><br><span>Email</span><br>desarahmat@gmail.com</p>
          </article>
          <article id='tabs-6'>
            <h4>Reviews</h4>
            <?php
            include 'db_connect.php';
            
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['review'])) {
              $reviewContent = $_POST['review'];
              $listingID = $_POST['listing_id'];
              $userID = $_SESSION['user_id'];
              $rating = $_POST['rating'];
              
              $stmt = $conn->prepare("INSERT INTO Reviews (ListingID, UserID, Review, Rating) VALUES (?, ?, ?, ?)");
              $stmt->bind_param("iisi", $listingID, $userID, $reviewContent, $rating);
              $stmt->execute();
              $stmt->close();
            }
            
            $stmt = $conn->prepare("SELECT * FROM Reviews WHERE ListingID = ?");
            $stmt->bind_param("i", $listingID);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
              while ($review = $result->fetch_assoc()) {
                echo "<p><strong>Rating:</strong> " . $review['Rating'] . "/5</p>";
                echo "<p>" . $review['Review'] . "</p><hr>";
              }
            } else {
              echo "<p>No reviews yet.</p>";
            }
            
            $stmt->close();
            $conn->close();
            ?>
            
            <h4>Submit a Review</h4>
            <?php if (isset($_SESSION['user_id'])): ?>
            <form method="post" action="">
              <input type="hidden" name="listing_id" value="<?php echo $listingID; ?>">
              <div class="form-group">
                <label for="review">Review</label>
                <textarea name="review" id="review" class="form-control" rows="3"></textarea>
              </div>
              <div class="form-group">
                <label for="rating">Rating</label>
                <select name="rating" id="rating" class="form-control">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                </select>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <?php else: ?>
            <p>Please <a href="login.php">login</a> to submit a review.</p>
            <?php endif; ?>
          </article>
        </section>
      </div>
    </div>
  </div>
</section>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Book for a Stay</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Make an enquiry by sending us an email about your desired stay.</p>
        <div class="main-button">
          <a href="contact.php">Contact us</a>
        </div>
      </div>
    </div>
  </div>
</div>

<footer>
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="about-footer">
          <div class="logo">
            <img src="./assets/images/logov2.png" alt="VoyageLux Logo">
          </div>
          <p>We are dedicated to offering exceptional homestay services. Your comfort is our priority.</p>
          <ul class="social-media">
            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
          </ul>
        </div>
      </div>
      <div class="col-md-6">
        <div class="footer-menu">
          <h4>Quick Links</h4>
          <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="listings.php">Listings</a></li>
            <li><a href="about.php">About Us</a></li>
            <li><a href="contact.php">Contact Us</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</footer>

<script src="assets/js/jquery-2.1.0.min.js"></script>
<script src="assets/js/popper.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/scrollreveal.min.js"></script>
<script src="assets/js/waypoints.min.js"></script>
<script src="assets/js/jquery.counterup.min.js"></script>
<script src="assets/js/imgfix.min.js"></script>
<script src="assets/js/custom.js"></script>
</body>
</html>
