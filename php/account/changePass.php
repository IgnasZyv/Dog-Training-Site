
<?php
// Set session variable for the server to find the appropriate location.
$_SESSION['fromAccount'] = true;
require('../server.php');

// if the user is not logged in they will be redirected to the main page and displayed the message.
if (!isset($_SESSION['email'])) {
    $_SESSION['NoPermission'] = "You are not allowed to see this page!";
    header('location: ../home.php');
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/account/account.css">
    <title>Admin Panel</title>
</head>
<body>
    <!-- Main navigation -->
    <div class="navbar" id="home">
        <div class="container">
            <a class="logo" href="../home.php">A Dog's <span>Life</span></a>
            <img id="menu-cta" class="mobile-menu" src="../../resources/assets/Icon material-menu.svg" alt="menu button">
            <nav>
                <img id="menu-exit" class="mobile-menu-exit" src="../../resources/assets/x-mark-64.svg" alt="menu exit">
                <ul class="primary-nav">
                    <li><a href="../home.php">Home</a></li>
                    <li><a href="../services.php">Services</a></li>
                    <li><a href="../pricing.php">Pricing</a></li>
                </ul>
                <ul class="secondary-nav">
                    <!-- If the user is logged in instead of Log in and Register they will be displayed their email -->
                  <?php if(isset($_SESSION['email'])) : ?>
                      <li><strong><a href="account-main.php"><?php echo $_SESSION['email']; ?></a></strong></li>
                      <li><a href="../home.php?logout='1'">logout</a></li>
                  <?php else : ?>
                      <li><a href="../loginform.php">Log In</a></li>
                      <li><a href="../registerform.php">Register</a></li>
                  <?php endif; ?>

                  <li><a href="#contact-us">Contact us</a></li>
                  <li class="book-cta"><a href="../booking.php">Book now</a></li>
                </ul>
            </nav> 
        </div>
    </div>
  </div>
  <!-- If this session variable is set it will be displayed as a notification pop up -->
  <?php if (isset($_SESSION['success'])) : ?>
        <div id="overlay" onclick="overlayOff()" >
            <div class="container">
                <h3>
                <?php 
                    echo $_SESSION['success']; 
                    unset($_SESSION['success']);
                ?>
                </h3>
            </div>
        </div>
  	<?php endif ?>
  <section class="main-banner">
        <div class="container">
            <div class="center">
                <h1>My Account</h1>
            </div>
        </div>
    </section>
    <section class="account-sec">
        <div class="container">
            <div class="nav">
                <!-- Second navigation for the account section -->
                <ul>
                    <li><a href="account-main.php" id="first-li">Account Information</a></li>
                    <li><a href="comBookings.php">My Bookings</a></li>
                    <!-- Only display the admin panel if the user is an admin -->
                    <?php if(isset($_SESSION['admin'])) : ?>
                        <li><a href="admin/adminMain.php">Admin Panel</a></li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="main-box">
                <h2>Change Password</h2>
                <div class="changePass">
                    <form action="changePass.php" method="POST">
                        <div>
                            <!-- if a specific error variable is set the div with get a class of form error wich will add css to make it red and display the error -->
                            <div <?php if (isset($oldPassWrongError)): ?> class="form-error" <?php endif ?> >
                                <label for="oldPass">Old Password: *</label>
                                    <?php 
                                        if (isset($oldPassWrongError)): ?>
                                            <span><?php echo $oldPassWrongError; ?></span>
                                    <?php endif ?>
                                <input type="password" id="oldPass" name="oldPass" required> <br>
                            </div>
                            
                            <!-- When user clicks on the password field thid div will appear. -->
                            <div id="validation">
                                <p id="letter" class="invalid">A lowercase letter</p>
                                <p id="capital" class="invalid">A capital (uppercase) letter</p>
                                <p id="Pnumber" class="invalid">A number</p>
                                <p id="length" class="invalid">Minimum 6 characters</p>
                            </div>

                            <div <?php if (isset($passDontMatchError)): ?> class="form-error" <?php endif ?> >
                                <label for="password">New Password: *</label>
                                    <?php 
                                        if (isset($passDontMatchError)): ?>
                                            <span><?php echo $passDontMatchError; ?></span>
                                    <?php endif ?>
                                <input type="password" id="password" name="newPass" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" required>
                            </div>

                            <label for="cnfrmPass">Confirm Password: *</label>
                            <input type="password" id="cnfrmPass" name="cnfrmPass" required>

                            <input class="submit-cta" type="submit" name="changePass" value="Submit">
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </section>

    <script src="../../js/validation.js"></script>
    <script src="../../js/nav.js"></script>
    
</body>
</html>