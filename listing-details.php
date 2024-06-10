<?php
include 'db_connect.php';

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

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
    $description = "description not found";
    $price = "price not found";
  }

  $stmt->close();
} else {
  $listing_title = "No listing ID provided";
}

$conn->close();
?>

<?php
include 'db_connect.php';

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

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
    
    <!-- ***** Preloader Start ***** -->
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
    <!-- ***** Preloader End ***** -->
    
    
    <?php
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
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
</header>


    <!-- Profile Modal -->
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
    <!-- End Profile Modal -->

    <!-- ***** Call to Action Start ***** -->
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
    <!-- ***** Call to Action End ***** -->

    <!-- ***** Fleet Starts ***** -->
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
                    <h4>Vacation Extras</h4>

                    <div class="row">
                       <div class="col-sm-6">
                              <p>Air condition</p>
                         </div>
                         <div class="col-sm-6">
                              <p>Pool</p>
                         </div>
                         <div class="col-sm-6">
                              <p>Fully equipped kitchen</p>
                         </div>
                    </div>
                  </article>
                  <article id='tabs-2'>
                    <h4>Vacation Description</h4>
                    
                    <p><?php echo $description ?></p> 
                   </article>
                  <article id='tabs-3'>
                    <h4>Availability &amp; Prices</h4>

                    <div class="table-responsive">
                      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
                         <thead>
                              <tr>
                                   <th>Homestay Price</th>
                                   <th>Price per Pax</th>
                              </tr>
                         </thead>
                         
                         <tbody>
                              <tr>
                                  <td>RM<?php echo $price ?> per night</td>
                                   <td></td>
                                   <td></td>
                                   <td></td>
                              </tr>
                         </tbody>
                      </table>
                    </div>
                  </article>
                 
                  <article id='tabs-5'>
                    <h4>Contact Details</h4>

                    <div class="row">   
                        <div class="col-sm-6">
                            <label>Name</label>

                            <p>John Smith</p>
                        </div>
                        <div class="col-sm-6">
                            <label>Phone</label>

                            <p>123-456-789 </p>
                        </div>
                        <div class="col-sm-6">
                            <label>Mobile phone</label>
                            <p>456789123 </p>
                        </div>
                        <div class="col-sm-6">
                            <label>Email</label>
                            <p><a href="#">john@carsales.com</a></p>
                        </div>
                    </div>

                    <img src="assets/images/map.jpg" class="img-fluid" alt="">
                  </article>
                </section>
                <div class="tab-pane" id="tabs-6" role="tabpanel">
                    <h4>Reviews</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="features-items">
                                <li class="feature-item">
                                    <div class="left-icon">
                                        <img src="assets/images/gmbr kimi.jpg" height="90" width="87" alt="First One">
                                    </div>
                                    <div class="right-content">
                                        <h4>Mi J</h4>
                                        <p>"A great option to run away from hectic life."</p>
                                    </div>
                                </li>
                                <li class="feature-item">
                                    <div class="left-icon">
                                        <img src="assets/images/gmbr pokka.jpg" height="90" width="87" alt="second one">
                                    </div>
                                    <div class="right-content">
                                        <h4>Pokka</h4>
                                        <p>"Swimming for life. That's for sure."</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-6">
                            <ul class="features-items">
                                <li class="feature-item">
                                    <div class="left-icon">
                                        <img src="assets/images/qeri.jpg" height="90" width="87" alt="third one">
                                    </div>
                                    <div class="right-content">
                                        <h4>al-Qori</h4>
                                        <p><em>"Inner peace is when you don't stress"</em></p>
                                    </div>
                                </li>
                                <li class="feature-item">
                                    <div class="left-icon">
                                        <img src="assets/images/Qema.jpg" height="90" width="87" alt="fourth one">
                                    </div>
                                    <div class="right-content">
                                        <h4>Qemal</h4>
                                        <p>"Smash through life. If not I dont know la."</p>
                                    </div>
                                </li>
                            </ul>
                            <!-- ***** Add Review Button Start ***** -->
                            <section class="section" id="add-review">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-12 text-center">
                                            <div class="main-button">
                                                <a href="#" data-toggle="modal" data-target="#addReviewModal">Add Review</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <!-- ***** Add Review Button End ***** -->


                              <!-- Add Review Modal -->
                              <div class="modal fade" id="addReviewModal" tabindex="-1" role="dialog" aria-labelledby="addReviewModalLabel" aria-hidden="true">
                                  <div class="modal-dialog modal-lg" role="document">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <h5 class="modal-title" id="addReviewModalLabel">Add Review</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                              </button>
                                          </div>
                                          <div class="modal-body">
                                              <form id="add-review-form">
                                                  <div class="form-group">
                                                      <label for="review-rating">Rating:</label>
                                                      <input type="number" class="form-control" id="review-rating" name="review-rating" min="1" max="5" placeholder="1 ~ 5"required>
                                                  </div>
                                                  <div class="form-group">
                                                      <label for="review-description">Description:</label>
                                                      <textarea class="form-control" id="review-description" name="review-description" rows="4" placeholder="comment about your experiences here" required></textarea>
                                                  </div>
                                                  <button type="submit" class="btn btn-primary">Submit Review</button>
                                              </form>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                        </div>
                    </div>
                </div>
                
</section>
    <!-- ***** Fleet Ends ***** -->

     <!-- ***** Make Reservation Button Start ***** -->
  <section class="section" id="make-reservation">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <div class="main-button">
            <a href="#" data-toggle="modal" data-target="#reservationModal">Make Reservation</a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ***** Make Reservation Button End ***** -->


    
    <!-- ***** Footer Start ***** -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p>
                        Copyright © 2024 Zen Corporation</a>
                    </p>
                </div>
            </div>
        </div>
    </footer>

 <!-- Enquiry Modal -->
 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Send us an enquiry</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="contact-us">
            <div class="contact-form">
              <form action="#" id="contact">
                <div class="row">
                  <div class="col-md-6">
                    <fieldset>
                      <input type="text" class="form-control" placeholder="Enter full name" required="">
                    </fieldset>
                  </div>
                  <div class="col-md-6">
                    <fieldset>
                      <input type="text" class="form-control" placeholder="Enter email address" required="">
                    </fieldset>
                  </div>
                  <div class="col-md-6">
                    <fieldset>
                      <input type="text" class="form-control" placeholder="Enter phone" required="">
                    </fieldset>
                  </div>
                  <div class="col-md-6">
                    <fieldset>
                      <input type="text" class="form-control" placeholder="Enter subject" required="">
                    </fieldset>
                  </div>
                  <div class="col-lg-12">
                    <fieldset>
                      <textarea rows="6" class="form-control" placeholder="Enter your enquiry" required=""></textarea>
                    </fieldset>
                  </div>
                  <div class="col-lg-12">
                    <fieldset>
                      <button type="submit" id="form-submit" class="filled-button">Send Now</button>
                    </fieldset>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Reservation Modal -->
  <div class="modal fade" id="reservationModal" tabindex="-1" role="dialog" aria-labelledby="reservationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="reservationModalLabel">Make a Reservation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="contact-us">
            <div class="contact-form">
              <form action="#" id="reservation">
                <div class="row">
                  <div class="col-md-6">
                    <fieldset>
                      <input type="text" class="form-control" placeholder="Enter full name" required="">
                    </fieldset>
                  </div>
                  <div class="col-md-6">
                    <fieldset>
                      <input type="text" class="form-control" placeholder="Enter email address" required="">
                    </fieldset>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <fieldset>
                      <input type="text" id="from-date" class="form-control" placeholder="From date" required="">
                    </fieldset>
                  </div>
                  <div class="col-md-6">
                    <fieldset>
                      <input type="text" id="to-date" class="form-control" placeholder="To date" required="">
                    </fieldset>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <fieldset>
                      <input type="text" class="form-control" placeholder="Number of guests" required="">
                    </fieldset>
                  </div>
                  <div class="col-md-6">
                    <fieldset>
                      <textarea class="form-control" placeholder="Additional requests" rows="4"></textarea>
                    </fieldset>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary">Submit Reservation</button>
        </div>
      </div>
    </div>
  </div>


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