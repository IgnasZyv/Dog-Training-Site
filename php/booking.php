<?php
require('bookingscript.php');

if (isset($_POST['book'])) {
    require('server.php');
}

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="../css/booking/booking.css">
    <title>Booking</title>
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
                        <li><a href="../php/account/account-main.php"><?php echo $_SESSION['email']; ?></a></li>
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
            <h1>Booking</h1>
        </div>
    </div>
</section>
<section class="booking-sec">


    <div class="container">
        <div class="left-container">
            <div class="text-left">
                <h2>Our Schedule:</h2>
                <h3>Monday-Friday</h3>
                <p>9am-18pm</p>
                <h3>Saturday-Sunday</h3>
                <p>We're closed.</p>
            </div>
        </div>

        <div id="time-right">
            <p>Please select the time below.</p>
            <p>Displaying the times for: </p>
            <span><?php echo $_SESSION['disp_date'] . " - " . $_SESSION['showing_day']; ?></span>
            <ul id="time-list">
            <?php foreach($unused_times as $key=>$val){ ?>
                <li id="<?php echo $val; ?>"><?php echo $val; ?></li>
            <?php } ?>
            </ul>
        </div>
        
        <div>
            <?php if (isset($_POST['book'])): ?>
                <div <?php if (count($errors) > 0): ?> class="form-error" <?php endif ?> >
                    <?php if (count($errors) > 0): ?>
                        <ul>
                        <?php foreach($errors as $key=>$val){ ?>
                            <li><?php echo $val; ?></li>
                        <?php } ?>
                        </ul>
                    <?php endif ?>
                </div>
            <?php endif ?>

            <form action="booking.php" method="POST">
                <label for="date">Enter the date: </label>
                <div class="date-time">
                    <input type="text" id="date" name="date" value="<?php echo $day;?>" readonly >
                    <input type="text" id="time" name="time" placeholder="time" readonly><br>
                </div>
                
                <label for="message">What is the meeting for?</label>
        
                <textarea name="message" id="message" cols="30" maxlength="50"></textarea><br>
                <small id="char-left">50 characters left</small> <br>

                <input class="submit-cta" type="submit" name="book" value="Submit">
            </form>
        </div>
        
    </div>
</section>

<script src="../js/scripts.js"></script>
<script src="../js/nav.js"></script>
</body>
</html>