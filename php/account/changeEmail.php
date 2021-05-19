
<?php
// Set session variable for the server to find the appropriate location.
$_SESSION['fromAccount'] = true;
require('../includes/server.inc.php');

// if the user is not logged in they will be redirected to the main page and displayed the message.
if (!isset($_SESSION['email'])) {
    $_SESSION['msg'] = "You are not allowed to see this page!";
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
  <?php if (isset($_SESSION['msg'])) : ?>
        <div id="overlay" onclick="overlayOff()" >
            <div class="container">
                <h3>
                <?php 
                    echo $_SESSION['msg']; 
                    unset($_SESSION['msg']);
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
                <h2>Change Email</h2>
                <div class="changeAcc">
                    <form action="changeEmail.php" method="POST">
 
                         <!-- If the error is set the form-error class will get placed on this div which will style it -->
                        <div <?php if (isset($passwordsDifferent)): ?> class="form-error" <?php endif ?> >
                            <label for="password">Password: *</label>
                            <!-- The error message will be displayed above the input field. -->
                            <?php
                                if (isset($passwordsDifferent)): ?>
                                    <span><?php echo $passwordsDifferent; ?></span>
                            <?php endif ?>
                            <input type="password" name="password" id="password" required>
                        </div>
                         
                        <div <?php if (isset($email_taken_error) || isset($email_error)): ?> class="form-error" <?php endif ?> >
                            <label for="newEmail">New Email: *</label>

                            <?php if (isset($email_taken_error)): ?>
                                <span><?php echo $email_taken_error; ?></span>
                            <?php endif ?>

                            <?php if (isset($email_error)): ?>
                                <span><?php echo $email_error; ?></span>
                            <?php endif ?>

                            <input type="email" name="newEmail" id="newEmail" required>
                        </div>
                        
                        <label for="cnfrmEmail">Confirm Email: *</label>
                        <input type="email" name="cnfrmEmail" id="cnfrmEmail" required>

                        <input class="submit-cta" type="submit" name="changeEmail">
                    </form>
                </div>
                
            </div>
        </div>
    </section>

    <script src="../../js/validation.js"></script>
    <script src="../../js/nav.js"></script>
    
</body>
</html>