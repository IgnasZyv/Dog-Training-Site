<?php
require_once("../../../db/db_connect.php");
// If the user is not an admin redirects the user home and displays a message
if (!isset($_SESSION['admin'])) {
    $_SESSION['msg'] = "You are not allowed to see this page!";
    header('location: ../home.php');
}
// Take current users email
$email = $_SESSION['email'];

// Sorts all of the user entries by role so the admins will be displayed first
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="../../../css/account/admin/admin.css">
    <title>Admin Panel</title>
</head>
<body>
<!-- Main navigation -->
    <div class="navbar" id="home">
        <div class="container">
            <a class="logo" href="../../home.php">A Dog's <span>Life</span></a>
            <img id="menu-cta" class="mobile-menu" src="../../resources/assets/Icon material-menu.svg" alt="menu button">

            <nav>
                <img id="menu-exit" class="mobile-menu-exit" src="../../resources/assets/x-mark-64.svg" alt="menu exit">
                <ul class="primary-nav">
                    <li><a href="../../home.php">Home</a></li>
                    <li><a href="../../services.php">Services</a></li>
                    <li><a href="../../pricing.php">Pricing</a></li>
                </ul>
                <ul class="secondary-nav">
                    <!-- If the user is logged in instead of Log in and Register they will be displayed their email -->
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
                <!-- Secondary navigation for the account -->
                <ul>
                    <li><a href="../account-main.php" id="first-li">Account Information</a></li>
                    <li><a href="../comBookings.php">My Bookings</a></li>
                    <!-- If the user logged in is admin display this list item -->
                    <?php if(isset($_SESSION['admin'])) : ?>
                        <li><strong><a href="adminMain.php">Admin Panel</a></strong></li>
                    <?php endif; ?>
                </ul>
            </div>
            <!-- Supportive navigation for the admin page -->
            <div class="nav-right">
                <ul>
                    <li><a href="adminMain.php">View Bookings</a></li>
                    <li><a href="adminPrevBookings.php">Previous Bookings</a></li>
                    <li><strong><a href="adminUsers.php">View Users</a></strong></li>
                    <li><a href="addAdmin.php">Add Users</a></li>
                </ul>
            </div>
            <div class="main-box">
                <div class="flex-container">

                    <div class="users">
                        <h2>Users</h2>
                        <div class="inputContainer">
                            <input type="text" id="searchInput" placeholder="Search.." style="margin-right: 35em;">
                        </div>
                        <!-- Table for displaying users from the database -->
                        <table id="users-info">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Surname</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone Number</th>
                                    <th scope="col">role</th>
                                </tr>
                            </thead>
                            <tbody id="fromDatabase">
                                <!-- For every entry user in the database -->
                                <?php foreach($userRows as $key=>$val){ ?>       
                                    <!-- if the user from the database is an admin add the class to that row for styling -->
                                    <?php if ($val['role'] == '0') : ?>
                                        <tr class="rowAdmin">
                                            <!-- A button for delete the row which is used by js -->
                                            <td><input type="button" class="delete" value="Delete"></td>
                                            <td><?php echo $val['name']; ?></td>
                                            <td><?php echo $val['surname'];?></td>
                                            <td><?php echo $val['email']; ?></td>
                                            <td><?php echo $val['Pnumber']; ?></td>
                                            <td>Admin</td>
                                            <td class="id" style="display:none;"><?php echo $val['user_id']; ?></td>
                                        </tr>
                                    <!-- Otherwise don't add the class with no special styling -->
                                    <?php else : ?>
                                        <tr class="row">
                                            <!-- A button for delete the row which is used by js -->
                                            <td><input type="button" class="delete" value="Delete"></td>
                                            <td><?php echo $val['name']; ?></td>
                                            <td><?php echo $val['surname'];?></td>
                                            <td><?php echo $val['email']; ?></td>
                                            <td><?php echo $val['Pnumber']; ?></td>
                                            <td>User</td>
                                            <td class="id" style="display:none;"><?php echo $val['user_id']; ?></td>
                                        </tr>
                                    <?php endif; ?>
                                <?php } ?>
                            </tbody>
                            <tr>
                            
                            </tr>
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
            var id = tr.find('td.id').text();
            console.log('clicked button with id', id);

            // PHP script will delete a row with the email provided
            var data = { 'userId': id };

            // ask confirmation
            if (confirm('Are you sure you want to delete this entry?')) {
                console.log('sending request');
                // delete record only once user has confirmed
                $.post('adminScript.inc.php', data, function (res) {
                    console.log('received response', res);
                    // we want to delete the table row only if we received a response back saying that it worked
                    if (res == "success") {
                        console.log('deleting row');
                        tr.remove();
                    } else {
                        console.log('Did not delete.')
                    }   
                });
            }
        });


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