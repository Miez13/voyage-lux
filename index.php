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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    
    <!-- Include Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Custom CSS for Profile Modal -->
    <style>
        .profile-icon {
            cursor: pointer;
            font-size: 20px;
            color: #fff;
        }
        .modal-content {
            padding: 20px;
        }
        .modal-header {
            border-bottom: none;
        }
        .modal-footer {
            border-top: none;
        }
    </style>
</head>

<body>
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
                <a href="userlistings.php?user_id=<?php echo $_SESSION['user_id']; ?>" class="btn btn-primary">View Listings</a>
                <a href="reservations.php" class="btn btn-success">View Reservations</a>
                <a href="users.php" class="btn btn-warning">Edit Info</a>
            </div>
        </div>
    </div>
</div>






    <!-- ***** Main Banner Area Start ***** -->
    <div class="main-banner" id="top">
        <video autoplay muted loop id="bg-video">
            <source src="assets/images/video.mp4" type="video/mp4" />
        </video>

        <div class="video-overlay header-text">
            <div class="caption">
                <h6>Enjoy the moment to the fullest during vacation</h6>
                <h2>A perfect <br><em>Homestay to relax with</em></h2>
                <!--<div class="main-button">
                    <a href="contact.php">Contact Us</a>
                </div>-->
            </div>
        </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->

    <!-- ***** Featured Homestay Section Start ***** -->
    <section class="section" id="trainers">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-heading">
                        <h2>Featured <em>Homestay</em></h2>
                        <img src="assets/images/line-dec.png" alt="">
                        <p>Providing you wide range of homestay to choose from.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                include 'db_connect.php';
                
                $sql = "SELECT * FROM Listing";
                $result = $conn->query($sql);

                while($row = $result->fetch_assoc()) {
                    $listing_id = $row["ListingID"];
                    echo "<div class='col-lg-4'>
                            <div class='trainer-item'>
                                <div class='image-thumb'>
                                    <img src='' alt=''>
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
                                        <li><a href='listing-details.php?id=$listing_id'>+ View More</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>";
                }
                ?>
                <!-- Example Listings (for demo purposes) -->
                <div class="col-lg-4">
                    <div class="trainer-item">
                        <div class="image-thumb">
                            <img src="assets/images/rumah/rumah 1.jpg" alt="">
                        </div>
                        <div class="down-content">
                            <span>
                                RM 111.00 - RM 611.00
                            </span>
                            <h4>Rumah Singgah</h4>
                            <p>
                                <i class="fa fa-map-marker"></i> Machang, Kelantan
                            </p>
                            <ul class="social-icons">
                                <li><a href="listing-details.php">+ View More</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="trainer-item">
                        <div class="image-thumb">
                            <img src="assets/images/rumah/product-5-720x480.jpg" alt="">
                        </div>
                        <div class="down-content">
                            <span>
                                RM 250.00 - RM 750.00
                            </span>
                            <h4>Perhentian Dream</h4>
                            <p>
                                <i class="fa fa-map-marker"></i> Perhentian Island, Terengganu
                            </p>
                            <ul class="social-icons">
                                <li><a href="listing-details.php">+ View More</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <br>

            <div class="main-button text-center">
                <a href="listings.php">View all listings</a>
            </div>
        </div>
    </section>
    <!-- ***** Featured Homestay Section End ***** -->

    <!-- ***** About Us Section Start ***** -->
    <section class="section section-bg" id="schedule" style="background-image: url(assets/images/banner-image-1-1920x500.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-heading dark-bg">
                        <h2><em>About Us</em></h2>
                        <img src="assets/images/logoVL1.png" height="450" width="450" alt="">
                        <p>VoyageLux is a pioneering rental platform in Malaysia established by Zen Corp. We specialize in simplifying the rental process for both property owners and renters. Our online platform centralizes rental listings, streamlines the rental process, and enhances transparency and trust in the rental market.
                            <br><br>We aim to make Voyage Lux as an online marketplace and hospitality service platform specifically in Malaysia that allows people to rent homestays. The accommodations listed on our website; instead, it serves as a broker, connecting hosts , individuals who want to rent out their properties, with guests, travelers seeking accommodation.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** About Us Section End ***** -->

    <!-- ***** Call to Action Start ***** -->
    <section class="section section-bg" id="call-to-action" style="background-image: url(assets/images/banner-image-1-1920x500.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="cta-content">
                        <h2>Send us a <em>message</em></h2>
                        <p>Our 24/7 line always available for you to help about your reservation.</p>
                        <div class="main-button">
                            <a href="contact.php">Contact us</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Call to Action End ***** -->

    <!-- ***** Testimonials Section Start ***** -->
    <section class="section" id="features">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-heading">
                        <h2>Read Other Users' <em>Reviews</em></h2>
                        <img src="assets/images/line-dec.png" alt="waves">
                        <p>Help you to decide whether to make reservations</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ul class="features-items">
                        <li class="feature-item">
                            <div class="left-icon">
                                <img src="assets/images/gmbr kimi.jpg" height="90" width="87" alt="First One">
                            </div>
                            <div class="right-content">
                                <h4>Mi J</h4>
                                <p>"A great choice to run away from hectic life."</p>
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
                                <img src="assets/images/qeri.jpg" height="90" width="87" alt="fourth muscle">
                            </div>
                            <div class="right-content">
                                <h4>al-Qori</h4>
                                <p><em>"Inner peace is when you don't stress"</em></p>
                            </div>
                        </li>
                        <li class="feature-item">
                            <div class="left-icon">
                                <img src="assets/images/Qema.jpg" height="90" width="87" alt="training fifth">
                            </div>
                            <div class="right-content">
                                <h4>Qemal</h4>
                                <p>"Smash through life. If not I dont know la."</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <br>

            <div class="main-button text-center">
                <a href="testimonials.php">Read More</a>
            </div>
        </div>
    </section>
    <!-- ***** Testimonials Section End ***** -->

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
