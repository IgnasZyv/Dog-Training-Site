<?php
require_once("../../db/db_connect.php");

if (!isset($_SESSION['admin'])) {
    $_SESSION['NoPermission'] = "You are not allowed to see this page!";
    header('location: ../home.php');
}

$email = $_SESSION['email'];

$bookingQuery = "SELECT * FROM booking ORDER BY bookedDate, time  ASC";

$result = mysqli_query($db, $bookingQuery);

$bookingRows = array();

// $date = new dateTime("now");
// $currentDate = $date->format('Y-m-d');

$passedBookings = array();
$comingBookings = array();

$oneDaysAgo = new DateTime("-1 days");

if ($result->num_rows > 0) {
// output data of each row
    while($row = $result->fetch_assoc()) {

        if (new dateTime($row['bookedDate']) < new dateTime()) {
            echo "Checking if older " . $row['bookedDate'] . "<br>";

            if(new dateTime($row['bookedDate']) < $oneDaysAgo){ 
                // it's been longer than one day
                echo "day is not longer than 1: " . $row['bookedDate'] . "<br>";
            } else {
                array_push($passedBookings, $row);
            }
            
        

    } else {
                array_push($comingBookings, $row);
            }
}
}

$userQuery = "SELECT * FROM users ORDER BY user_id ASC";

$result = mysqli_query($db, $userQuery);

$userRows = array();

if ($result->num_rows > 0) {
// output data of each row
    while($row = $result->fetch_assoc()) {
        array_push($userRows, $row);
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/account/admin/admin.css">
    <title>Admin Panel</title>
</head>
<body>
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
                <h1>Admin Panel</h1>
            </div>
        </div>
    </section>

  <section class="account-sec">
        <div class="container">
            <div class="nav">
                <ul>
                    <li><a href="#" id="first-li">Account Information</a></li>
                    <li><a href="fetchbooking.php">My Bookings</a></li>
                    <?php if(isset($_SESSION['admin'])) : ?>
                        <li><strong><a href="admin.php">Admin Panel</a></strong></li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="main-box">

                <div class="flex-container">
                    <div class="bookings">
                        <h2>Boookings</h2>


                            <?php if (count($passedBookings) > 0) : ?>
                                <h4>Passed Bookings:</h4>
                                <table id="booking-info">
                                    <tr>
                                        <th scope="col">Booking Date</th>
                                        <th scope="col">Time</th>
                                        <th scope="col">Reason</th>
                                        <th scope="col">Date Of Booking</th>
                                    </tr>
                                    <?php foreach($passedBookings as $key=>$val){ ?>
                                        <tr>
                                            <td><?php echo $val['bookedDate']; ?></td>
                                            <td><?php echo date('H:i A', strtotime($val['time']));?></td>
                                            <td><?php echo $val['reason']; ?></td>
                                            <td><?php echo $val['dateOfBooking']; ?></td>
                                        </tr>
                                    <?php } ?>
                                </table>
                                <h4>Upcoming Bookings:</h4>
                                <table id="booking-info">
                                    <tr>
                                        <th scope="col">Booking Date</th>
                                        <th scope="col">Time</th>
                                        <th scope="col">Reason</th>
                                        <th scope="col">Date Of Booking</th>
                                    </tr>
                                    <?php foreach($comingBookings as $key=>$val){ ?>
                                        <tr>
                                            <td><?php echo $val['bookedDate']; ?></td>
                                            <td><?php echo date('H:i A', strtotime($val['time']));?></td>
                                            <td><?php echo $val['reason']; ?></td>
                                            <td><?php echo $val['dateOfBooking']; ?></td>
                                        </tr>
                                    <?php } ?>
                                </table>
                                <?php else : ?>
                                    <table id="booking-info">
                                        <tr>
                                            <th scope="col">Booking Date</th>
                                            <th scope="col">Time</th>
                                            <th scope="col">Reason</th>
                                            <th scope="col">Date Of Booking</th>
                                        </tr>
                                        <?php foreach($comingBookings as $key=>$val){ ?>
                                            <tr>
                                                <td><?php echo $val['bookedDate']; ?></td>
                                                <td><?php echo date('H:i A', strtotime($val['time']));?></td>
                                                <td><?php echo $val['reason']; ?></td>
                                                <td><?php echo $val['dateOfBooking']; ?></td>
                                            </tr>
                                        <?php } ?>
                                    </table>
                                <?php endif; ?>
                        </table>
                    </div>

                    <div class="users">
                        <h2>Users</h2>

                        <table id="users-info">
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Surname</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone Number</th>
                            </tr>
                            <tr>
                            <?php foreach($userRows as $key=>$val){ ?>
                                <tr>
                                    <td><?php echo $val['name']; ?></td>
                                    <td><?php echo $val['surname'];?></td>
                                    <td><?php echo $val['email']; ?></td>
                                    <td><?php echo $val['Pnumber']; ?></td>
                                </tr>
                            <?php } ?>
                            </tr>
                        </table>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
    
</body>
</html>