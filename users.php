<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

    <title>User Profile - VoyageLux</title>

    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    
    <style>
        .profile-container {
            max-width: 600px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .profile-container img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            display: block;
            margin: 0 auto 20px;
        }
        .profile-container p {
            text-align: center;
            margin: 10px 0;
        }
        .profile-container p strong {
            display: block;
            margin-bottom: 5px;
        }
        
        .main-content {
        margin-top: 100px;
        }

        .content-area {
        padding-top: 100px; /* Adjust this value to match the height of your header */
        }
    </style>
</head>

<body>
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
                                    <a href="users.php" class="profile-icon">
                                        <i class="fa fa-user"></i> <?php echo htmlspecialchars($_SESSION['user_name']); ?>
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

    
    <div class="container-fluid main-content">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="sidebar-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item" style="margin-top: 10px;">
                            <a class="nav-link" href="userInfo.php" onclick="loadContent('userInfo')">
                                <i class="fas fa-user"></i>
                                User Info
                            </a>
                        </li>
                        <li class="nav-item" style="margin-top: 10px;">
                            <a class="nav-link" href="#" onclick="loadContent('edit_user_info')">
                                <i class="fas fa-edit"></i>
                                Edit User Info
                            </a>
                        </li>
                        <li class="nav-item" style="margin-top: 10px;">
                            <a class="nav-link" href="#" onclick="loadContent('view_listings')">
                                <i class="fas fa-list"></i>
                                View Listings
                            </a>
                        </li>
                        <li class="nav-item" style="margin-top: 10px;">
                            <a class="nav-link" href="#" onclick="loadContent('view_reservations')">
                                <i class="fas fa-calendar-check"></i>
                                View Reservations
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main content
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div id="content" class="profile-container">
                    <img src="<//?php echo htmlspecialchars($_SESSION['user_picture']); ?>" alt="Profile Picture">
                    <p><strong>User ID:</strong> <//?php echo htmlspecialchars($_SESSION['user_id']); ?></p>
                    <p><strong>Username:</strong> <//?php echo htmlspecialchars($_SESSION['user_name']); ?></p>
                    <p><strong>Email:</strong> <//?php echo htmlspecialchars($_SESSION['user_email']); ?></p>
                </div>
            </main>
        </div>
    </div-->

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
