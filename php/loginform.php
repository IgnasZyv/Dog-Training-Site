<?php require('server.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login/login.css">
    <title>Log in</title>
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
                    <li><strong><a href="../php/loginform.php">Log In</a></strong></li>
                    <li><a href="../php/registerform.php">Register</a></li>
                    <li><a href="#contact-us">Contact us</a></li>
                    <li class="book-cta"><a href="../php/booking.php">Book now</a></li>
                </ul>
            </nav> 
        </div>
    </div>
    <section class="main-banner">
        <div class="container">
            <div class="center">
                <h1>Log in</h1>
            </div>
        </div>
    </section>
    <?php if (isset($_SESSION['loginFirst'])) : ?>
        <div id="overlay" onclick="overlayOff()" >
            <div class="container">
                <h3>
                <?php 
                    echo $_SESSION['loginFirst']; 
                    unset($_SESSION['loginFirst']);
                ?>
                </h3>
            </div>
        </div>
  	<?php endif ?>
    <section class="login-sec">
        <div class="container">
            <div>

                <form action="../php/loginform.php" method="POST">
                    <div class="form-error">
                    <?php if (isset($login_error)) : ?>
                        <span>
                        <?php 
                            echo $login_error;
                        ?>
                        </span>
                    <?php endif ?>
                    </div>
                    <label for="email">Email:</label>
                    <input type="text" id="email" name="email" required><br>
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required><br>
                    <input class="submit-cta" type="submit" name="login" value="Submit">
                </form> 
            </div>
        </div>
        <div class="login-img">
            <img src="../resources/assets/Login img.jpg" alt="Happy Corgi">
        </div>
    </section>
    <script src="../js/scripts.js"></script>
    <script src="../js/nav.js"></script>
</body>
</html>