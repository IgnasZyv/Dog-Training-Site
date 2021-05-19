<?php

require_once("../../db/db_connect.php");
// Current logged in user's email
$email = $_SESSION['email'];

// Take all of the bookings that this user made
$bookingQuery = "SELECT * FROM booking WHERE email = '$email' ORDER BY bookedDate, time  ASC";

    $result = mysqli_query($db, $bookingQuery);

    $passedBookings = array();

    $today = strtotime("today");
    
    // If there was an entry
    if ($result->num_rows > 0) {
    // output data of each row
        while($row = $result->fetch_assoc()) {
            // Create dateTime object with the time taken so I can compare it with the current date.
            // If the booked date is passed push it into the passed Bookings array
            $date = $row['bookedDate'];
            $bookedDate = strtotime($date);
            
            if ($bookedDate < $today) {
                array_push($passedBookings, $row);

            }
        }
    } else {
        $emptyArray = "No bookings were found.";
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/account/account.css">
    <title>Previous Bookings</title>
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
                      <li><strong><a href="account/account-main.php"><?php echo $_SESSION['email']; ?></a></strong></li>
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
                <!-- Secondary navigation for the account -->
                <ul>
                    <li><a href="account-main.php" id="first-li">Account Information</a></li>
                    <li><strong><a href="comBookings.php">My Bookings</a></strong></li>
                    <!-- If the user logged in is admin display this list item -->
                    <?php if(isset($_SESSION['admin'])) : ?>
                        <li><a href="admin/adminMain.php">Admin Panel</a></li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="nav-right">
                <ul>
                    <li><a href="comBookings.php">Upcoming Bookings</a></li>
                    <li><strong><a href="prevBookings.php">Previous Bookings</a></strong></li>
                </ul>
            </div>
            <div class="main-box">
                <h2>Previous Boookings</h2>
                <div style="overflow-x:auto;">
                <!-- Table for displaying previous bookings -->
                    <table id="Booking-information">
                        <tr>
                            <th scope="col">Booking Date</th>
                            <th scope="col">Time</th>
                            <th scope="col">Reason</th>
                            <th scope="col">Date Of Booking</th>
                        </tr>
                        <?php if(!isset($emptyArray)) : ?>
                            <!-- For every entery in the passedBookings array, creates a table row -->
                            <?php foreach($passedBookings as $key=>$val){ ?>
                                <tr>
                                    <td><?php echo $val['bookedDate']; ?></td>
                                    <!-- Convert the time recieved from database so I can format it to display the AM and PM -->
                                    <td><?php echo date('H:i A', strtotime($val['time']));?></td>
                                    <td><?php echo $val['reason']; ?></td>
                                    <td><?php echo $val['dateOfBooking']; ?></td>
                                </tr>
                            <?php } ?>
                        <?php else : ?>
                            <caption><?php echo $emptyArray; ?></caption>
                        <?php endif ;?>
                    </table>
                    </table>
                </div>
            </div>
        </div>
    </section>
</body>
</html>