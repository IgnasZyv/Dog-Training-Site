<?php
    session_start();

    // if (!isset($_SESSION['email'])) {
    //     $_SESSION['msg'] = "You must log in first";
    //     header('location: ../../php/login/loginform.php');
    // }
    
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['email']);
        header("location: ../php/home.php");
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/home/home.css">

    <title>Home</title>
</head>
<body>
      <div class="navbar" id="home">
          <div class="container">
              <a class="logo" href="../php/home.php">A Dog's <span>Life</span></a>
              <img id="menu-cta" class="mobile-menu" src="../resources/assets/Icon material-menu.svg" alt="menu button">

              <nav>
                  <img id="menu-exit" class="mobile-menu-exit" src="../resources/assets/x-mark-64.svg" alt="menu exit">
                  <ul class="primary-nav">
                      <li><strong><a href="../php/home.php">Home</a></strong></li>
                      <li><a href="../php/services.php">Services</a></li>
                      <li><a href="../php/pricing.php">Pricing</a></li>
                  </ul>
                  <ul class="secondary-nav">

                    <?php if(isset($_SESSION['email'])) : ?>
                        <li><a href="account/account-main.php"><?php echo $_SESSION['email']; ?></a></li>
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
    <?php if (isset($_SESSION['booking_msg'])) : ?>
        <div id="overlay" onclick="overlayOff()" >
            <div class="container">
                <h3>
                <?php 
                    echo $_SESSION['booking_msg']; 
                    unset($_SESSION['booking_msg']);
                ?>
                </h3>
            </div>
        </div>
  	<?php endif ?>

    <section class="main-body">
        <div class="container">
            <div class="main-container">
                <div class="message">
                </div>
                <div class="headings">
                    <h1>Happy dog,<br> Happy <span>life!</span></h1>
                    <p class="subhead">They deserve it.</p>
                </div>
                
                <div class="main-cta">
                    <a href="../php/booking.php" class="primary-cta">First meeting is free</a>
                </div>

                <div class="image">
                    <img class="main-img" src="../resources/assets/dog-4988985_1280.svg" alt="smiling dog image">
                </div>
            </div>
        </div>
    </section>
    <section class="services-section">
        <div class="container">
            <ul class="services-list">
                <li class="training">Training</li>
                <li class="walking">Walking</li>
                <li class="grooming">Grooming</li>
                <li class="daycare">Daycare</li>
                <li class="vacation">Vacation</li>
            </ul>
            <img src="../resources/assets/Mask Group 1.svg" alt="Smiling dog">
        </div>
    </section>
    <section class="feedback-section">
        <div class="container">
            <ul>
                <li>
                    <img src="../resources/assets/max-ilienerwise-YvWJOXHNJ94-unsplash Cropped.svg" alt="Person">
                    <blockquote>"Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor alksjdf jadjfo  jlkasjdf poeirj  lkjasdf osdifj kj lkj;sadfoisdjf lkj lkdsjfoia ejw invidunt ut."</blockquote>
                    <cite>- Erin Lee</cite>
                </li>
                <li>
                    <img src="../resources/assets/max-ilienerwise-YvWJOXHNJ94-unsplash Cropped.svg" alt="Person">
                    <blockquote>"Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut."</blockquote>
                    <cite>- Erin Lee</cite>
                </li>
                <li>
                    <img src="../resources/assets/max-ilienerwise-YvWJOXHNJ94-unsplash Cropped.svg" alt="Person">
                    <blockquote>"Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut."</blockquote>
                    <cite>- Erin Lee</cite>
                </li>
            </ul>
        </div>
    </section>
    <section class="contact-section">
        <div class="container">
            <div class="contact-left" id="contact-us">
                <h2>Contact Us</h2>
                <form action="">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name">

                    <label for="email">Email:</label>
                    <input type="email" id="email" email="email">

                    <label for="message">Message:</label>
                    <textarea name="message" id="message" cols="30" rows="10"></textarea>

                    <input type="submit" class="send-cta" value="Send Message">
                </form>
            </div>
            <div class="contact-right">
                <iframe title="Our location on the map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d589.1940125686037!2d-1.7546403478567685!3d53.79347334331391!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x487be1495910c173%3A0x8da2e0881c3990d4!2sSunbridge%20Rd%2C%20Bradford%20BD1%202AA%2C%20UK!5e0!3m2!1sen!2ses!4v1616200935111!5m2!1sen!2ses" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </section>
    <div class="back-top">
        <a href="#home"><img src="../resources/assets/BackTop.svg" alt="Go back to the top"></a>
    </div>
    <script src="../js/nav.js"></script>

    <script src="../js/scripts.js"></script>
</body>
</html>