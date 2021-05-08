<?php
    session_start();
    if (!isset($_SESSION['email'])) {
        $_SESSION['loginFirst'] = "You must log in first";
        header('location: ../php/loginform.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/account/account.css">
    <title>Account</title>
</head>
<body>
    <div class="navbar" id="home">
        <div class="container">
            <a class="logo" href="../php/home.php">A Dog's <span>Life</span></a>
            <img id="menu-cta" class="mobile-menu" src="../resources/assets/Icon material-menu.svg" alt="menu button">

            <nav>
                <img id="menu-exit" class="mobile-menu-exit" src="../resources/assets/x-mark-64.svg" alt="menu exit">
                <ul class="primary-nav">
                    <li><a href="../php/home.php">Home</a></li>
                    <li><a href="../php/services.php">Services</a></li>
                    <li><a href="../php/pricing.php">Pricing</a></li>
                </ul>
                <ul class="secondary-nav">

                  <?php if(isset($_SESSION['email'])) : ?>
                      <li><strong><a href="account-main.php"><?php echo $_SESSION['email']; ?></a></strong></li>
                      <li><a href="../php/home.php?logout='1'">logout</a></li>
                  <?php else : ?>
                      <li><a href="../php/loginform.php">Log In</a></li>
                      <li><a href="../php/registerform.php">Register</a></li>
                  <?php endif; ?>

                  <li><a href="#contact-us">Contact us</a></li>
                  <li class="book-cta"><a href="../php/booking.php">Book now</a></li>

                </ul>
            </nav> 
        </div>
    </div>
  </div>
  <section class="main-banner">
        <div class="container">
            <div class="center">
                <h1>My Account</h1>
            </div>
        </div>
    </section>

  <section class="account-sec">
        <div class="container">
            <div class="main-box">
                
                    <div class="nav">
                        <ul>
                            <li><strong><a href="#" id="first-li">Account Information</a></strong></li>
                            <li><a href="#">My Bookings</a></li>
                        </ul>

                    </div>

            </div>
        </div>
  </section>
    
</body>
</html>