<?php
    require_once("../../db/db_connect.php");
    if (!isset($_SESSION['email'])) {
        $_SESSION['loginFirst'] = "You must log in first!";
        header('location: ../loginform.php');
    }

    


    $email = $_SESSION['email'];

    $userQuery = "SELECT name, surname, Pnumber FROM users WHERE email = '$email' LIMIT 1";
    $result = mysqli_query($db, $userQuery);
    $user = mysqli_fetch_assoc($result);

    $name = $user['name'];
    $surname = $user['surname'];
    $pNumber = $user['Pnumber'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/account/account.css">
    <title>Account</title>
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
                <h1>My Account</h1>
            </div>
        </div>
    </section>
    <?php if (isset($_SESSION['updSuccess'])) : ?>
        <div id="overlay" onclick="overlayOff()" >
            <div class="container">
                <h3>
                <?php 
                    echo $_SESSION['updSuccess']; 
                    unset($_SESSION['updSuccess']);
                ?>
                </h3>
            </div>
        </div>
  	<?php endif ?>
    <?php if (isset($_SESSION['updFail'])) : ?>
        <div id="overlay" onclick="overlayOff()" >
            <div class="container">
                <h3>
                <?php 
                    echo $_SESSION['updFail']; 
                    unset($_SESSION['updFail']);
                ?>
                </h3>
            </div>
        </div>
    <?php endif ?>
  <section class="account-sec">
        <div class="container">
            <div class="nav">
                <ul>
                    <li><strong><a href="#" id="first-li">Account Information</a></strong></li>
                    <li><a href="comBookings.php">My Bookings</a></li>
                    <?php if(isset($_SESSION['admin'])) : ?>
                        <li><a href="admin/adminMain.php">Admin Panel</a></li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="main-box">
                <h2>My Information</h2>
                <div style="overflow-x:auto;">
                    <table id="user-information">
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Surname</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone Number</th>
                        </tr>
                        <tr>
                            <td><?php echo $name; ?></td>
                            <td><?php echo $surname; ?></td>
                            <td><?php echo $email; ?></td>
                            <td><?php echo $pNumber; ?></td>
                        </tr>
                    </table>
                </div>
                

                <div class="change-info">
                    <ul>
                        <li><a href="changePass.php">Change Password</a></li>
                        <li>Change Email</li>
                        <li>Change Phone Number</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    
</body>
</html>