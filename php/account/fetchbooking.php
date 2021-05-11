<?php

require_once("../../db/db_connect.php");

$email = $_SESSION['email'];
echo $email;
$bookingQuery = "SELECT bookedDate, time, reason, dateOfBooking FROM booking WHERE email = '$email' 
ORDER BY `booking`.`bookedDate`, `booking`.`time`  ASC";
$result = mysqli_query($db, $bookingQuery);
// $booking = mysqli_fetch_assoc($result);
$bookingRows = array();
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    array_push($bookingRows, $row);
    }
}



print_r($bookingRows);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/account/account.css">
    <title>Booking information</title>
</head>
<body>
<div class="navbar" id="home">
        <div class="container">
            <a class="logo" href="../home.php">A Dog's <span>Life</span></a>
            <img id="menu-cta" class="mobile-menu" src="../resources/assets/Icon material-menu.svg" alt="menu button">

            <nav>
                <img id="menu-exit" class="mobile-menu-exit" src="../resources/assets/x-mark-64.svg" alt="menu exit">
                <ul class="primary-nav">
                    <li><a href="../home.php">Home</a></li>
                    <li><a href="../services.php">Services</a></li>
                    <li><a href="../pricing.php">Pricing</a></li>
                </ul>
                <ul class="secondary-nav">

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
                <ul>
                    <li><a href="account-main.php" id="first-li">Account Information</a></li>
                    <li><strong><a href="fetchbooking.php">My Bookings</a></strong></li>
                </ul>
            </div>
            <div class="main-box">
                <div style="overflow-x:auto;">
                    <table id="user-information">
                        <tr>
                            <th scope="col">Booking Date</th>
                            <th scope="col">Time</th>
                            <th scope="col">Reason</th>
                            <th scope="col">Date Of Booking</th>
                        </tr>

                        <?php foreach($bookingRows as $key=>$val){ ?>
                            <tr>
                                <td><?php echo $val['bookedDate']; ?></td>
                                <td><?php echo date('H:i A', strtotime($val['time']));?></td>
                                <td><?php echo $val['reason']; ?></td>
                                <td><?php echo $val['dateOfBooking']; ?></td>
                            </tr>
                        <?php } ?>


                    </table>
                </div>
            </div>
        </div>
    </section>
                
</body>
</html>