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

    <section class="section section-bg" id="call-to-action" style="background-image: url(assets/images/banner-image-1-1920x500.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="cta-content">
                        <br>
                        <br>
                        <h2><em>About Us</em></h2>
                        <img src="assets/images/logoVL1.png" height="450" width="450">
                        <p>VoyageLux is a pioneering rental platform in Malaysia established by Zen Corp. We specialize in simplifying the rental process for both property owners and renters. Our online platform centralizes rental listings, streamlines the rental process, and enhances transparency and trust in the rental market. 
                            <br><br>We aim to make Voyage Lux as an online marketplace and hospitality service platform specifically in Malaysia that allows people to rent homestays. The accommodations listed on our website; instead, it serves as a broker, connecting hosts , individuals who want to rent out their properties, with guests, travelers seeking accommodation.
                            </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ***** Our Classes Start ***** -->
    <section class="section" id="our-classes">
        <div class="container">
            <br>
            <br>
            <br>
            <div class="row" id="tabs">
              <div class="col-lg-4">
                <ul>
                  <li><a href='#tabs-1'><!--<i class="fa fa-soccer-ball-o">--><img src="assets/images/run icon.png" height="50" width="50" alt=""></i> Our Vision</a></li>
                  <li><a href='#tabs-2'><!--<i class="fa fa-briefcase">--><img src="assets/images/check list.png" height="50" width="50" alt=""></i> Our Mission</a></a></li>
                  <!--<li><a href='#tabs-3'><i class="fa fa-heart"></i> Our Passion</a></a></li>-->
                </ul>
              </div>
              <div class="col-lg-8">
                <section class='tabs-content'>
                  <article id='tabs-1'>
                    <img src="assets/images/about-image-1-940x460.jpg" alt="">
                    <h4>Our Vision</h4>

                    <p>"To become the trusted gateway for secure and seamless rental transactions, connecting travelers and property owners worldwide with integrity and ease."</p>

                    
                    This vision emphasizes the role of VoyageLux as a trusted platform in the rental market, highlighting the importance of security and seamless interactions between property owners and renters.

                  </article>
                  <article id='tabs-2'>
                    <img src="assets/images/about-image-2-940x460.jpg" alt="">
                    <h4>Our Mission</h4>
                    <p>"VoyageLux's mission is to facilitate secure, transparent, and efficient connections between property owners and travelers. We are dedicated to safeguarding payments and providing a reliable marketplace where every transaction is an opportunity for a delightful and scam-free rental experience."</p>
                    This mission statement explicitly states our commitment to security and transparency, focusing on the core functionality of our platform as a broker that ensures every transaction is safe and satisfactory for both parties.
                    <br><br>These revised statements clearly reflect our platform's role and its commitment to security, aiming to build trust and deliver excellent service in the property rental market.

                  </article>
                  <!--<article id='tabs-3'>
                    <img src="assets/images/about-image-3-940x460.jpg" alt="">
                    <h4>Our Passion</h4>
                    <p>Fusce laoreet malesuada rhoncus. Donec ultricies diam tortor, id auctor neque posuere sit amet. Aliquam pharetra, augue vel cursus porta, nisi tortor vulputate sapien, id scelerisque felis magna id felis. Proin neque metus, pellentesque pharetra semper vel, accumsan a neque.</p>

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Porro aut beatae commodi repudiandae distinctio, magnam blanditiis reiciendis vitae velit voluptatum natus, fugit quis eos dolores!</p>

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic adipisci reiciendis quaerat qui earum aut, atque esse quisquam quis exercitationem sapiente, dolorum consequatur consequuntur voluptatibus ipsam, fuga magnam beatae optio nam. Recusandae ut aliquid, eligendi.</p>
                  </article>-->
                </section>
              </div>
            </div>
        </div>
    </section>
    <!-- ***** Our Classes End ***** -->

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