<!-- userListings.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
    <title>VoyageLux Homestay Reservation Website</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <!-- ***** Preloader Start *****
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
    ***** Preloader End ***** -->

    <?php
        include 'db_connect.php';
        session_start();
    ?>
    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="index.php" class="logo">
                        VoyageLux <span>by Zen Corp</span>
                        <img src="./assets/images/logoVL2.1.png" alt="logo Image" class="img-logo">
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
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
                                <a href="#" onclick="document.getElementById('logout-form').submit();">Log out</a>
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
                            <li><a href="login.php">Log in</a></li>
                        <?php endif; ?>      
                    </ul>
                    <a class="menu-trigger">
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
</header>

<!-- Profile Modal -->
<div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
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
                <a href="listings.php?user_id=<?php echo $_SESSION['user_id']; ?>" class="btn btn-primary">View Listings</a>
                <a href="reservations.php" class="btn btn-success">View Reservations</a>
                <a href="users.php" class="btn btn-warning">Edit Info</a>
            </div>
        </div>
    </div>
</div>

<!-- ***** Call to Action Start ***** -->
<section class="section section-bg" id="call-to-action" style="background-image: url(assets/images/banner-image-1-1920x500.jpg)">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="cta-content">
                    <br>
                    <br>
                    <h2>My <em>Listings</em></h2>
                    <p>Manage your homestay listings here</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ***** Call to Action End ***** -->

<!-- ***** User Listings Starts ***** -->
<section class="section" id="trainers">
    <div class="container">
        <br>
        <br>
        <div class="row">

        <?php
        $user_id = $_SESSION['user_id'];
        $sql = "SELECT * FROM Listing WHERE UserID = '$user_id'";
        $result = $conn->query($sql);

        while($row = $result->fetch_assoc()) {
            $listingID = $row["ListingID"];
            echo "<div class='col-lg-4'>
                    <div class='trainer-item'>
                        <div class='image-thumb'>
                            <img src='" . $row["ListingPicture"] . "' alt=''>
                        </div>
                        <div class='down-content'>
                            <span>
                                RM " . $row["Price"]. ".00
                            </span>
                            <h4>" . $row["Title"]. "</h4>
                            <p>
                                <i class='fa fa-map-marker'></i> " . $row["Location"]. "
                            </p>
                            <ul class='social-icons'>
                                <li><a href='listing-details.php?id=$listingID'>+ View More</a></li>
                                <li><a href='updateListingInfo.php?id=$listingID'>Edit</a></li>
                                <li><a href='deleteListings.php?id=$listingID'>Delete</a></li>
                            </ul>
                        </div>
                    </div>
                </div>";
        }
        ?>
        </div>

        <br>
        <nav>
          <ul class="pagination pagination-lg justify-content-center">
            <li class="page-item">
              <a class="page-link" href="#" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
              </a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
              <a class="page-link" href="#" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Next</span>
              </a>
            </li>
          </ul>
        </nav>

    </div>
</section>
<!-- ***** User Listings Ends ***** -->

<!-- ***** Footer Start ***** -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <p>
                    Copyright © 2024 Zen Corporation
                </p>
            </div>
        </div>
    </div>
</footer>

<!-- jQuery -->
<script src="assets/js/jquery-2.1.0.min.js"></script>

<!-- Bootstrap -->
<script src="assets/js/popper.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

<!-- Plugins -->
<script src="assets/js/scrollreveal.min.js"></script>
<script src="assets/js/waypoints.min.js"></script>
<script src="assets/js/jquery.counterup.min.js"></script>
<script src="assets/js/imgfix.min.js"></script> 
<script src="assets/js/mixitup.js"></script> 
<script src="assets/js/accordions.js"></script>
    
<!-- Global Init -->
<script src="assets/js/custom.js"></script>

</body>
</html>
