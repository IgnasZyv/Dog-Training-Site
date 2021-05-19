<?php
require('adminBooking.php');


// if (!isset($_SESSION['admin'])) {
//     $_SESSION['NoPermission'] = "You are not allowed to see this page!";
//     header('location: ../../home.php');
// }

if (!isset($_SESSION['admin'])) {
    $_SESSION['msg'] = "You are not allowed to see this page!";
    header('location: ../../home.php');
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="../../../css/account/admin/admin.css">
    <title>Admin Panel</title>
</head>
<body>
    <div class="navbar" id="home">
        <div class="container">
            <a class="logo" href="../../home.php">A Dog's <span>Life</span></a>
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
                <h1>Admin Panel</h1>
            </div>
        </div>
    </section>

  <section class="account-sec">
        <div class="container">
            <div class="nav">
                <ul>
                    <li><a href="account-main.php" id="first-li">Account Information</a></li>
                    <li><a href="comBookings.php">My Bookings</a></li>
                    <?php if(isset($_SESSION['admin'])) : ?>
                        <li><strong><a href="adminMain.php">Admin Panel</a></strong></li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="nav-right">
                <ul>
                    <li><strong><a href="admin.php">View Bookings</a></strong></li>
                    <li><a href="adminUsers.php">View Users</a></li>
                    <li><a href="addAdmin.php">Add Users</a></li>
                </ul>
            </div>
            <div class="main-box">
                <div class="flex-container">
                    <div class="bookings">
                        <h2>Upcoming Boookings</h2>
                        <table id="booking-info">
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">ID</th>
                                <th scope="col">Booking Date</th>
                                <th scope="col">Time</th>
                                <th scope="col">Reason</th>
                                <th scope="col">email</th>
                                <th scope="col">Date Of Booking</th>
                            </tr>
                            <div class="bookingRows">
                                <?php foreach($comingBookings as $key=>$val){ ?>
                                    <tr class="row">
                                        <td><input type="button" class="delete" value="Delete"></td>                                        
                                        <td class="bookingId"><?php echo $val['id']; ?></td>
                                        <td><?php echo $val['bookedDate']; ?></td>
                                        <td><?php echo date('H:i A', strtotime($val['time']));?></td>
                                        <td><?php echo $val['reason']; ?></td>
                                        <td><?php echo $val['email']; ?></td>
                                        <td><?php echo $val['dateOfBooking']; ?></td>
                                    </tr>
                                <?php } ?>
                            </div>
                            
                        </table>
                    </div>

                </div>

            </div>
        </div>
    </section>
    <script>
        // When delete button is pressed.
        $('.delete').click(function() {
            var button = $(this), 
            tr = button.closest('tr');
            // find the ID stored in the .groupId cell
            var id = tr.find('td.bookingId').text();
            console.log('clicked button with id', id);

            // your PHP script will delete a row from the id provided
            var data = { 'bookingID': id };

            // ask confirmation
            if (confirm('Are you sure you want to delete this entry?')) {
                console.log('sending request');
                // delete record only once user has confirmed
                $.post('adminBooking.php', data, function (res) {
                    console.log('received response', res);
                    // we want to delete the table row only if we received a response back saying that it worked
                    if (res == "status") {
                        console.log('deleting row');
                        tr.remove();
                    } else {
                        console.log('Did not delete.')
                    }   
                });
            }
        });

    </script>
</body>
</html>