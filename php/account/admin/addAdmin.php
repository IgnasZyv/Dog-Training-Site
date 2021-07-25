<?php
$_SESSION['fromAdmin'] = true;
require('../../includes/server.inc.php');

if (!isset($_SESSION['admin'])) {
    $_SESSION['msg'] = "You are not allowed to see this page!";
    header('location: ../../home.php');
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/account/admin/admin.css">
    <title>Admin Panel</title>
</head>
<body>
    <div class="navbar" id="home">
        <div class="container">
            <a class="logo" href="../../home.php">A Dog's <span>Life</span></a>
            <img id="menu-cta" class="mobile-menu" src="../../resources/assets/Icon material-menu.svg" alt="menu button">

            <nav>
                <img id="menu-exit" class="mobile-menu-exit" src="../../resources/assets/x-mark-64.svg" alt="menu exit">
                <ul class="primary-nav">
                    <li><a href="../../home.php">Home</a></li>
                    <li><a href="../../services.php">Services</a></li>
                    <li><a href="../../pricing.php">Pricing</a></li>
                </ul>
                <ul class="secondary-nav">

                  <?php if(isset($_SESSION['email'])) : ?>
                      <li><strong><a href="../account-main.php"><?php echo $_SESSION['email']; ?></a></strong></li>
                      <li><a href="../../home.php?logout='1'">logout</a></li>
                  <?php else : ?>
                      <li><a href="../../loginform.php">Log In</a></li>
                      <li><a href="../../registerform.php">Register</a></li>
                  <?php endif; ?>

                  <li><a href="#contact-us">Contact us</a></li>
                  <li class="book-cta"><a href="../../booking.php">Book now</a></li>
                </ul>
            </nav> 
        </div>
    </div>
  </div>
  <section class="main-banner">
        <div class="container">
            <div class="center">
                <h1>Admin Panel</h1>
            </div>
        </div>
    </section>

  <section class="account-sec">
        <div class="container">
            <div class="nav">
                <ul>
                    <li><a href="../account-main.php" id="first-li">Account Information</a></li>
                    <li><a href="../comBookings.php">My Bookings</a></li>
                    <?php if(isset($_SESSION['admin'])) : ?>
                        <li><strong><a href="adminMain.php">Admin Panel</a></strong></li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="nav-right">
                <ul>
                    <li><a href="adminMain.php">View Bookings</a></li>
                    <li><a href="adminPrevBookings.php">Previous Bookings</a></li>
                    <li><a href="adminUsers.php">View Users</a></li>
                    <li><strong><a href="addAdmin.php">Add Users</a></strong></li>
                </ul>
            </div>
            <div class="main-box">
                <div class="flex-container">
                    
                    <div class="register-admin">

                        <form name="login" action="addAdmin.php"  method="POST">
                        
                        <div 
                            <?php
                                if (isset($name_error)): ?> class="form-error" 
                            <?php endif ?> >
                            <label for="fname">Name: *</label>
                            <?php 
                                if (isset($name_error)): ?>
                                    <span><?php echo $name_error; ?></span>
                            <?php endif ?>
                            <input type="text" id="name" name="fname" required><br>
                        </div>
                        

                        <div 
                            <?php 
                                if (isset($surname_error)): ?> class="form-error" 
                            <?php endif ?> >
                            <label for="surname">Surname: *</label>
                            <?php 
                                if (isset($surname_error)): ?>
                                    <span><?php echo $surname_error; ?></span>
                            <?php endif ?>
                            <input type="text" id="surname" name="surname" required><br>
                        </div>


                        <div 
                            <?php 
                                if (isset($email_taken_error) || isset($email_error)): ?> class="form-error" 
                            <?php endif ?> >
                            <label for="email">Email: *</label>
                            <?php 
                                if (isset($email_taken_error)): ?>
                                    <span><?php echo $email_taken_error; ?></span>
                            <?php endif ?>
                            <?php 
                                if (isset($email_error)): ?>
                                    <span><?php echo $email_error; ?></span>
                            <?php endif ?>
                            <input type="email" id="email" name="email" required><br>
                        </div>

                        <label for="number">Phone Number:</label>
                        <input type="text" id="number" name="number" pattern="[0-9]+" maxlength="12" required><br>

                        <div id="validation">
                            <p id="letter" class="invalid">A lowercase letter</p>
                            <p id="capital" class="invalid">A capital (uppercase) letter</p>
                            <p id="Pnumber" class="invalid">A number</p>
                            <p id="length" class="invalid">Minimum 6 characters</p>
                        </div>

                        <div 
                            <?php 
                                if (isset($password_error)): ?> class="form-error" 
                            <?php endif ?> >
                            <label for="password">Password: *</label>
                            <?php 
                                if (isset($password_error)): ?>
                                    <span><?php echo $password_error; ?></span>
                            <?php endif ?>
                            <input type="password" id="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" required> <br>
                            <label class="confirm-password" for="cnfrm-password">Confirm Password: *</label>
                            <input type="password" id="cnfrm-password" name="cnfrm-password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" required>
                        </div>

                        <input class="submit-cta" type="submit" name="register" value="Submit">
                        </form>
                    </div>

            </div>
        </div>
    </section>

    <script src="../../js/validation.js"></script>
    <script src="../../js/nav.js"></script>
    
</body>
</html>