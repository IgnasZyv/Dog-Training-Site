<?php
require_once("../../../db/db_connect.php");

if (!isset($_SESSION['admin'])) {
    $_SESSION['NoPermission'] = "You are not allowed to see this page!";
    header('location: ../home.php');
}

$email = $_SESSION['email'];


$userQuery = "SELECT * FROM users ORDER BY role ASC";

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
    <link rel="stylesheet" href="../../../css/account/admin/admin.css">
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
                    <li><a href="../../home.php">Home</a></li>
                    <li><a href="../../services.php">Services</a></li>
                    <li><a href="../../pricing.php">Pricing</a></li>
                </ul>
                <ul class="secondary-nav">

                  <?php if(isset($_SESSION['email'])) : ?>
                      <li><strong><a href="account/account-main.php"><?php echo $_SESSION['email']; ?></a></strong></li>
                      <li><a href="../../home.php?logout='1'">logout</a></li>
                  <?php else : ?>
                      <li><a href="../../loginform.php">Log In</a></li>
                      <li><a href="../../registerform.php">Register</a></li>
                  <?php endif; ?>

                  <li><a href="#contact-us">Contact us</a></li>
                  <li class="book-cta"><a href="../../booking.php">Book now</a></li>
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
                    <li><a href="../account-main.php" id="first-li">Account Information</a></li>
                    <li><a href="../comBookings.php">My Bookings</a></li>
                    <?php if(isset($_SESSION['admin'])) : ?>
                        <li><strong><a href="adminMain.php">Admin Panel</a></strong></li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="nav-right">
                <ul>
                    <li><a href="adminMain.php">View Bookings</a></li>
                    <li><strong><a href="adminUsers.php">View Users</a></strong></li>
                    <li><a href="addAdmin.php">Add Users</a></li>
                </ul>
            </div>
            <div class="main-box">
                <div class="flex-container">

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
                                <?php if ($val['role'] == '0') : ?>
                                    <tr class="rowAdmin">
                                        <td><?php echo $val['name']; ?></td>
                                        <td><?php echo $val['surname'];?></td>
                                        <td><?php echo $val['email']; ?></td>
                                        <td><?php echo $val['Pnumber']; ?></td>
                                    </tr>
                                <?php else : ?>
                                    <tr class="row">
                                        <td><?php echo $val['name']; ?></td>
                                        <td><?php echo $val['surname'];?></td>
                                        <td><?php echo $val['email']; ?></td>
                                        <td><?php echo $val['Pnumber']; ?></td>
                                    </tr>
                                <?php endif; ?>
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