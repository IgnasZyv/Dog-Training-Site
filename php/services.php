<?php
    session_start();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/services/services.css">
    <title>Dog's Life Services</title>
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
                    <li><strong><a href="../php/services.php">Services</a></strong></li>
                    <li><a href="../php/pricing.php">Pricing</a></li>
                </ul>
                <ul class="secondary-nav">
                    <!-- If the user is logged in instead of Log in and Register they will be displayed their email -->
                    <?php if(isset($_SESSION['email'])) : ?>
                        <li><a href="account/account-main.php"><?php echo $_SESSION['email']; ?></a></li>
                        <li><a href="../php/home.php?logout='1'">logout</a></li>
                    <?php else : ?>
                        <li><a href="../loginform.php">Log In</a></li>
                        <li><a href="../registerform.php">Register</a></li>
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
                <h1>Our Services</h1>
            </div>
        </div>
    </section>
    <section class="training-sec">
        
        <div class="container">
            <div class="training-pic">
                <img src="../resources/assets/training.svg" alt="Dog Training Picture">
            </div>
            
            <div>
                <h1>Training</h1>
                <h2>Looking for the best training for your loved one?</h2>
                <p class="header">Well, look no further.<br> <br> We provide the least intrusive and supportive approach to  
                    training your loves ones!</p>

                <div class="text-container">
                    <div class="text-left">
                        <h3>One to One Training</h3>
                        <p>We offer personalised training services meaning after the first meeting we will talk with the owner on what the problem is and how the want to proceed</p>
                    </div>
                    <div class="text-center">
                        <h3>Puppy Training</h3>
                        <p>Basic training for puppies, which is taught in small groups with exercise based learning.</p>
                    </div>
                    <div class="text-right">
                        <h3>Correct behaviour</h3>
                        <p>The goal is to teach the dog to behave when close to other people or dogs, as well as other problems such as excessive barking.</p>
                    </div>
                </div>
                <a href="pricing.php">Go to pricing</a>
                
            </div>
        </div>
    </section>
    <section class="walking-sec">
        <div class="container">
            <div class="walking-pic">
                <img src="../resources/assets/Walking.svg" alt="Dog Walking Picture">
            </div>
            <h1>Walking</h1>
            <div>
                <h2>Having a busy day? <br> Won't be able to take your dog for a walk? <br></h2>
                
                <p>No worries, we can take care of it! <br> We have two options regarding our walking service:</p>
                
                <div class="text-container">
                    <div class="text-left">
                        <h3>Bring him/her to us!</h3>
                        <p>
                            We can set a time for you to bring him/her to us and we will go for a walk!
                        </p>
                    </div>
                    <div class="text-right">
                        <h3>We can come to you!</h3>
                        <p>
                            We can set a time and come to your provided location!
                        </p>
                    </div>
                </div>
                <a href="pricing.php">Go to pricing</a>
            </div>
        </div>
    </section>
    
    <section class="grooming-sec">
        <div class="container">
            <div class="gooming-pic">
                <img src="../resources/assets/grooming.svg" alt="Dog Grooming Picture">
            </div>
            <div>
                <h1>Grooming</h1>
                <h2>Looking for the best grooming for your loved one?</h2>
                <p class="header">Well, look no further.<br> <br> We provide the least intrusive and supportive approach to  
                    grooming your loves ones!</p>

                <div class="text-container">
                    <div class="text-left">
                        <h3>Best Grooming</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut ac tempus leo. Nulla gravida commodo. </p>
                    </div>
                    <div class="text-center">
                        <h3>No Stress</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut ac tempus leo. Nulla gravida commodo. </p>
                    </div>
                    <div class="text-right">
                        <h3>Relax</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut ac tempus leo. Nulla gravida commodo. .</p>
                    </div>
                </div>
                <a href="pricing.php">Go to pricing</a>
                
            </div>
        </div>
    </section>
    <section class="daycare-sec">
        <div class="container">
            <div class="daycare-pic">
                <img src="../resources/assets/sleeping.svg" alt="Dog Sleeping Picture">
            </div>
            <div>
                <h1>Daycare</h1>

                <h2>Looking for most relaxing and exciting daycare for your loved one?</h2>
                <p class="header">Well, look no further.<br> <br> We provide the least intrusive and supportive approach to  
                    taking care of your loves ones!</p>

                <div class="text-container">
                    <div class="text-left">
                        <h3>Best Facilities</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut ac tempus leo. Nulla gravida commodo. </p>
                    </div>
                    <div class="text-center">
                        <h3>No Stress</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut ac tempus leo. Nulla gravida commodo. </p>
                    </div>
                    <div class="text-right">
                        <h3>Relax and enjoy</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut ac tempus leo. Nulla gravida commodo. .</p>
                    </div>
                </div>
                <a href="pricing.php">Go to pricing</a>
                
            </div>
        </div>
    </section>
    <section class="boarding-sec">
        <div class="container">
            <div class="boarding-pic">
                <img src="../resources/assets/boarding-dog.svg" alt="Dog on holiday Picture">
            </div>
            <div>
                <h1>Boarding</h1>
                <h2>Looking for most relaxing and exciting holidays for you and for your loved one?</h2>
                <p class="header">Well, look no further.<br> <br> We provide the least intrusive and supportive approach to  
                    taking care of your loves ones!</p>

                <div class="text-container">
                    <div class="text-left">
                        <h3>Best Facilities</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut ac tempus leo. Nulla gravida commodo. </p>
                    </div>
                    <div class="text-center">
                        <h3>No Stress</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut ac tempus leo. Nulla gravida commodo. </p>
                    </div>
                    <div class="text-right">
                        <h3>Relax and enjoy</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut ac tempus leo. Nulla gravida commodo. .</p>
                    </div>
                </div>
                
                <a href="pricing.php">Go to pricing</a>
                
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