<?php
// Different locations required depenting from where the request if coming from.
if (isset($_SESSION['fromAdmin'])) {
    require_once("../../../db/db_connect.php");
    unset($_SESSION['fromAdmin']);
} elseif (isset($_SESSION['fromAccount'])) {
    require_once("../../db/db_connect.php");
    unset($_SESSION['fromAccount']);
} else {
    require_once("../db/db_connect.php");
}


// Array for erros
$errors = array();

// Register the user
// If the method used to get here was post and variable register is set.
if (isset($_POST['register'])) {
    // collect value of input field
    $name = mysqli_real_escape_string($db, $_POST["fname"]);
    $surname = mysqli_real_escape_string($db, $_POST["surname"]);
    $email = mysqli_real_escape_string($db, $_POST["email"]);
    $Pnumber = mysqli_real_escape_string($db, $_POST["number"]);
    $password = mysqli_real_escape_string($db, $_POST["password"]);
    $re_password = mysqli_real_escape_string($db, $_POST["cnfrm-password"]);

    // Check if the form is valid
    // If name field has numbers.
    if (preg_match("/[0-9]/", $name)) {
        $name_error = "Name cannot have numbers.";
        array_push($errors, $name_error);
    }
    // If surname field has numbers
    if (preg_match("/[0-9]/", $surname)) {
        $surname_error = "Surname cannot have numbers.";
        array_push($errors, $surname_error);
    }
    // If email field does not contain a full stop it's not valid.
    if (!str_contains($email, ".")) {
        $email_error = "Email is not valid.";
        array_push($errors, $email_error);
    }
    // If both passwords are the same.
    if ($password != $re_password) {
        $password_error = "Passwords are not the same.";
        array_push($errors, $password_error);
    }


    // Check if the email is taken.
    $userCheck = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
    $result = mysqli_query($db, $userCheck);
    $user = mysqli_fetch_assoc($result);

    if (isset($user) && $user["email"] == $email) {
        $email_taken_error = "Sorry, Email already taken.";
        array_push($errors, $email_taken_error);
    }

    // Register the user if no errors were found.
    if (count($errors) == 0) {
        // encodes the password
        $password = md5($password);
        // If admin is logged in when the user is created it will make the user an admin
        if (isset($_SESSION['admin'])) {
            $query = "INSERT INTO users (name, surname, email, Pnumber, password, role) 
                VALUES('$name', '$surname','$email', '$Pnumber','$password', '0')";

            mysqli_query($db, $query);
            // A message to display when the user is created.
  	        $_SESSION['success'] = "Admin succesfully created";
              // Redirect the admin to the page when done
            header("location: addAdmin.php");

        } else {
            // When user is created through registration form the role is 1 which is default.
            $query = "INSERT INTO users (name, surname, email, Pnumber, password, role) 
                VALUES('$name', '$surname','$email', '$Pnumber','$password', '1')";

            mysqli_query($db, $query);
            // Sets a session veriable with the email which allows for user to be remembered while they are browsing pages.
            $_SESSION['email'] = $email;
            // A message to display when the user is created.
  	        $_SESSION['msg'] = "You are now logged in";
            // Redirect the user to the home page when done  
            header("location: home.php");
        }

    }

}
// If the method used to get here was post and variable login is set.
if (isset($_POST['login'])) {
    // Take user inputs
    $email = mysqli_real_escape_string($db, $_POST["email"]);
    $password = mysqli_real_escape_string($db, $_POST["password"]);

    //Validate entries
    // If email and password push the error into array folder
    if (empty($email)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    if (count($errors) == 0) {
        // Encode the password for comparison with the database
        $password = md5($password);
        // if the email matched the password provided 
        $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password' LIMIT 1";
        $results = mysqli_query($db, $query);
        $user = mysqli_fetch_assoc($results);
        
        if (isset($user)) {
            // Check the role of the user trying to log in.
            $roleQuery = "SELECT role FROM users WHERE email = '$email' LIMIT 1";
            $results = mysqli_query($db, $roleQuery);
            $role = mysqli_fetch_assoc($results);
            // If role is 0 it will be logged in as an admin normal user otherwise
            if ($role["role"] == 0) {
                $_SESSION['admin'] = "admin";
                $_SESSION['email'] = $email;
                // Message to display after log in
                $_SESSION['msg'] = "Admin succesfully logged in";
                
            } else {
                $_SESSION['email'] = $email;
                // Message to display after log in
                $_SESSION['msg'] = "You are now logged in";
            }
            header('location: home.php');
        }else {
            // Iff errors were found display the following error in the form
            $login_error = "Incorrect Email and Password!";
            array_push($errors, $login_error);
        }
    }
}

// If the method used to get here was post and variable book is set.
if (isset($_POST['book'])) {
    // Store users email as the sess_Email variable
    $sess_Email = $_SESSION['email'];
    // Date passed along with the form
    $sessCustomDate = $_SESSION['sessCustomDate'];
    // Take the details of the user who is trying to make a booking
    $query_email = "SELECT name, surname, email, Pnumber FROM users WHERE email='$sess_Email'";
    $email_result = mysqli_query($db, $query_email);
    $user_result = mysqli_fetch_assoc($email_result);

    // Set the variables from the query
    $name = $user_result["name"];
    $surname = $user_result["surname"];
    $email = $user_result["email"];
    $number = $user_result["Pnumber"];
    // The following came with the form
    $date = mysqli_real_escape_string($db, $_POST["date"]);
    $time = mysqli_real_escape_string($db, $_POST["time"]);
    $reason = mysqli_real_escape_string($db, $_POST["message"]);

    // if number has letters display an error in the form
    if (preg_match("/[a-z,A-Z]/", $number)) {
        $number_error = "Number field cannot have letters.";
        array_push($errors, $number_error);
    }
    // If reason field has numbers display an error in the form
    if (preg_match("/[0-9]/", $reason)) {
        $reason_error = "Reason field cannot have numbers.";
        array_push($errors, $reason_error);
    }

    // Take the current date and time
    $currentTime = new DateTime("now");
    // Convert the date given into DateTime object
    $chosenDate = new DateTime("$sessCustomDate");
    // convert the date given by the user into the y-m-d format
    $chosenDate = $chosenDate->format("Y-m-d");
    // Do the same with the current date
    $currentDate = $currentTime->format("Y-m-d");
    // Take the hour of the current time
    $hour = $currentTime->format("H");

    // If the current hour is 17 or greater and the current date is the same or older than now throw an error in the form
    if ($hour >= 17 && $chosenDate <= $currentDate) {
        $dateError = "Invalid date chosen (Can't go back in time).";
        array_push($errors, $dateError);
    }
    // If no errors were found
    if (count($errors) == 0) {
        // Inserts into the database booking table the following values
        $query = "INSERT INTO booking (name, surname, email, Pnumber, bookedDate, time, reason, dateOfBooking) 
                VALUES('$name', '$surname','$email','$number', '$chosenDate', '$time', '$reason', '$currentDate')";
        mysqli_query($db, $query);
        // Message to display if the booking was successfull
        $_SESSION['msg'] = "Succesfully booked a meeting!";
        header("Location: home.php");
    }
}

// If the method used to get here was post and variable changePass is set.
if (isset($_POST['changePass'])) {
    // Take the current email
    $email = $_SESSION['email'];
    // save the user inputs
    $oldPass = mysqli_real_escape_string($db, $_POST["oldPass"]);
    $newPass = mysqli_real_escape_string($db, $_POST["newPass"]);
    $cnfrmPass = mysqli_real_escape_string($db, $_POST["cnfrmPass"]);
    // Take the currently signed in users password
    $passQuery = "SELECT password FROM users WHERE email = '$email' LIMIT 1";
    $result = mysqli_query($db, $passQuery);
    $userPass = mysqli_fetch_assoc($result);
    // Encode the old provided password
    $mdPass = md5($oldPass);
    // If the old password doesn't match with the password from the database associated with the users email throw an error
    if ($userPass['password'] != $mdPass) {
        $oldPassWrongError = "Sorry, old password is not correct.";
        array_push($errors, $oldPassWrongError);
    }
    // if the new and confirm passwords don't match
    if ($newPass != $cnfrmPass) {
        $passDontMatchError = "Sorry, Passwords don't match.";
        array_push($errors, $passDontMatchError);
    }
    // If no errors were found
    if (count($errors) == 0) {
        // Encode new password
        $newPass = md5($newPass);
        // Update the users table with the new password for the users account
        $updPass = "UPDATE users SET password = '$newPass' WHERE email = '$email'";
        if (mysqli_query($db, $updPass)) {
            $_SESSION['msg'] = "Passwords updated successfully.";
        } else {
            $_SESSION['msg'] = "Password was not updated.";
            echo $db->error;
        }

        header("location: account-main.php");

    }

    

    
}