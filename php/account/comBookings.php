<?php

require_once("../../db/db_connect.php");
// Take the logged in users email
$email = $_SESSION['email'];
// Pull information regarding the bookings from that specific user
$bookingQuery = "SELECT bookedDate, time, reason, dateOfBooking FROM booking WHERE email = '$email' 
ORDER BY `booking`.`bookedDate`, `booking`.`time`  ASC";
$result = mysqli_query($db, $bookingQuery);

$comingBookings = array();

$today = strtotime("today");

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        // Check if the booking is upcoming and not passed
        $date = $row['bookedDate'];
        $bookedDate = strtotime($date);
        if ($bookedDate >= $today) {
            // Push that booking into the coming bookings array
            array_push($comingBookings, $row);

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="../../css/account/account.css">
    <title>Booking information</title>
</head>
<body>
    <!-- Main Navigation -->
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
                      <li><strong><a href="account-main.php"><?php echo $_SESSION['email']; ?></a></strong></li>
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
            <!-- Secondary navigation for the account -->
            <div class="nav">
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
                    <li><strong><a href="comBookings.php">Upcoming Bookings</a></strong></li>
                    <li><a href="prevBookings.php">Previous Bookings</a></li>
                </ul>
            </div>
            <div class="main-box">
                <h2>Upcoming Boookings</h2>
                <!-- Search box -->
                <div class="inputContainer">
                    <input type="text" id="searchInput" placeholder="Search..">
                </div>
                <div style="overflow-x:auto;">
                        <!-- Table for displaying upcoming bookings -->
                    <table>
                        <thead>
                            <tr>
                                <th scope="col">Booking Date</th>
                                <th scope="col">Time</th>
                                <th scope="col">Reason</th>
                                <th scope="col">Date Of Booking</th>
                            </tr>
                        </thead>
                        <tbody id="fromDatabase">
                            <?php if(!isset($emptyArray)) : ?>
                            <!-- For every entery in the comingBookings table creates a table row -->
                            <?php foreach($comingBookings as $key=>$val){ ?>
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
                        </tbody>
                        
                    </table>
                </div>
            </div>
        </div>
    </section>
    <script src="../js/nav.js"></script>
    <script>
        $(document).ready(function(){
            // When something is typed in the search box
            $("#searchInput").on("keyup", function() {
                // Store the input and change into into lowercase
                var input = $(this).val().toLowerCase();
                $("#fromDatabase tr").filter(function() {
                    // Loops throught the table rows changes everything to lowercase and checks if the input is in that row
                    $(this).toggle($(this).text().toLowerCase().indexOf(input) > -1)
                });
            });
        });
    </script>
</body>
</html>