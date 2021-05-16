<?php
    session_start();

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Pricing/pricing.css">
    <title>Pricing</title>
</head>
<body>
    <!-- Main navigation -->
    <div class="navbar" id="home">
        <div class="container">
            <a class="logo" href="../php/home.php">A Dog's <span>Life</span></a>
            <img id="menu-cta" class="mobile-menu" src="../resources/assets/Icon material-menu.svg" alt="menu button">

            <nav>
                <img id="menu-exit" class="mobile-menu-exit" src="../resources/assets/x-mark-64.svg" alt="menu exit">
                <ul class="primary-nav">
                    <li><a href="../php/home.php">Home</a></li>
                    <li><a href="../php/services.php">Services</a></li>
                    <li><strong><a href="../php/pricing.php">Pricing</a></strong></li>
                </ul>
                <ul class="secondary-nav">
                    <!-- If the user is logged in instead of Log in and Register they will be displayed their email -->
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
    <section class="main-banner">
        <div class="container">
            <div class="center">
                <h1>Pricing</h1>
            </div>
        </div>
    </section>
    <section class="table-sec">
        <div class="container">
            <div>
                <div class="dog-image">
                    <img src="../resources/assets/smiling dog.jpg" alt="Smiling dog image">
                </div>
                <p>We offer the following prices for our services:</p>
                <table>
                    <tr>
                        <th scope="col">Service</th>
                        <th scope="col">Per Meeting</th>
                        <th scope="col">Per Week</th>
                        <th scope="col">Per Month</th>
                        <th scope="col">Per Year</th>
                    </tr>
                    <tr class="row">
                        <td class="service">Training</td>
                        <td>£10</td>
                        <td>£30</td>
                        <td>£40</td>
                        <td>£50</td>
                    </tr>
                    <tr class="row">
                        <td class="service">Walking</td>
                        <td>£10</td>
                        <td>£30</td>
                        <td>£40</td>
                        <td>£50</td>
                    </tr>
                    <tr class="row">
                        <td class="service">Grooming</td>
                        <td>£10</td>
                        <td>£30</td>
                        <td>£40</td>
                        <td>£50</td>
                    </tr>
                    <tr class="row">
                        <td class="service">Daycare</td>
                        <td>£10</td>
                        <td>£30</td>
                        <td>£40</td>
                        <td>£50</td>
                    </tr>
                    <tr class="row">
                        <td class="service">Vacation</td>
                        <td>£10</td>
                        <td>£30</td>
                        <td>£40</td>
                        <td>£50</td>
                    </tr>
                </table>

                <div class="appointment-cta">
                    <a href="#">Book An Appointment Now!</a>
                </div>


            </div>
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
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d589.1940125686037!2d-1.7546403478567685!3d53.79347334331391!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x487be1495910c173%3A0x8da2e0881c3990d4!2sSunbridge%20Rd%2C%20Bradford%20BD1%202AA%2C%20UK!5e0!3m2!1sen!2ses!4v1616200935111!5m2!1sen!2ses" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
            
        </div>
    </section>
    <div class="back-top">
        <a href="#home"><img src="../resources/assets/BackTop.svg" alt="Go back to the top"></a>
    </div>
    <script src="../js/nav.js"></script>
</body>
</html>