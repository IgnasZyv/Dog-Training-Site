<?php require('server.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/register/register.css">
    <title>Register</title>
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
                    <li><a href="../php/loginform.php">Log In</a></li>
                    <li><strong><a href="../php/registerform.php">Register</a></strong></li>
                    <li><a href="#contact-us">Contact us</a></li>
                    <li class="book-cta"><a href="../php/booking.php">Book now</a></li>
                </ul>
            </nav> 
        </div>
    </div>
    <section class="main-banner">
        <div class="container">
            <div class="center">
                <h1>Register</h1>
            </div>
        </div>
    </section>
    <section class="register-sec">
        <div class="container">
            <div>
                <form name="login" action="../php/registerform.php"  method="POST">
                    
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

                    <div id="validation">
                        <p id="letter" class="invalid">A lowercase letter</p>
                        <p id="capital" class="invalid">A capital (uppercase) letter</p>
                        <p id="number" class="invalid">A number</p>
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
        <div class="login-a">
            <p>Already have an account? <a href="../login/loginform.php">Log In!</a></p>
        </div>
    
    </section>

    <script src="../js/register/validation.js"></script>
    <script src="../js/nav.js"></script>
</body>
</html>