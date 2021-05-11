<?php
require_once("../db/db_connect.php");

$errors = array();


// Register the user

if (isset($_POST['register'])) {
    // collect value of input field
    $name = mysqli_real_escape_string($db, $_POST["fname"]);
    $surname = mysqli_real_escape_string($db, $_POST["surname"]);
    $email = mysqli_real_escape_string($db, $_POST["email"]);
    $Pnumber = mysqli_real_escape_string($db, $_POST["number"]);
    $password = mysqli_real_escape_string($db, $_POST["password"]);
    $re_password = mysqli_real_escape_string($db, $_POST["cnfrm-password"]);

    // Check if the form is valid
    if (preg_match("/[0-9]/", $name)) {
        $name_error = "Name cannot have numbers.";
        array_push($errors, $name_error);
    }
    if (preg_match("/[0-9]/", $surname)) {
        $surname_error = "Surname cannot have numbers.";
        array_push($errors, $surname_error);
    }
    if (!str_contains($email, ".")) {
        $email_error = "Email is not valid.";
        array_push($errors, $email_error);
    }

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
        $password = md5($password);
        $query = "INSERT INTO users (name, surname, email, Pnumber, password, role) 
                VALUES('$name', '$surname','$email', '$Pnumber','$password', '1')";

        mysqli_query($db, $query);

        $_SESSION['email'] = $email;
  	    $_SESSION['success'] = "You are now logged in";

        header("location: home.php");
    }
    
    
    
}

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($db, $_POST["email"]);
    $password = mysqli_real_escape_string($db, $_POST["password"]);

    //Validate entries
    if (empty($email)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password' LIMIT 1";
        $results = mysqli_query($db, $query);
        $user = mysqli_fetch_assoc($results);
        if (isset($user)) {
            $_SESSION['email'] = $email;
            $_SESSION['success'] = "You are now logged in";

            header('location: home.php');
        }else {
            $login_error = "Incorrect Email and Password!";
            array_push($errors, $login_error);
        }
    }

}


if (isset($_POST['book'])) {
    // Check for users with the current logged in email.
    $sess_Email = $_SESSION['email'];
    $sessCustomDate = $_SESSION['sessCustomDate'];

    $query_email = "SELECT name, surname, email, Pnumber FROM users WHERE email='$sess_Email'";
    $email_result = mysqli_query($db, $query_email);
    
    $user_result = mysqli_fetch_assoc($email_result);
    // Set the variables
    $name = $user_result["name"];
    $surname = $user_result["surname"];
    $email = $user_result["email"];
    $number = $user_result["Pnumber"];
    $date = mysqli_real_escape_string($db, $_POST["date"]);
    $time = mysqli_real_escape_string($db, $_POST["time"]);
    $reason = mysqli_real_escape_string($db, $_POST["message"]);

    if (preg_match("/[a-z,A-Z]/", $number)) {
        $number_error = "Number field cannot have letters.";
        array_push($errors, $number_error);
    }
    if (preg_match("/[0-9]/", $reason)) {
        $reason_error = "Reason field cannot have numbers.";
        array_push($errors, $reason_error);
    }

    $currentTime = new DateTime("now");
    $chosenDate = new DateTime("$sessCustomDate");

    $chosenDate = $chosenDate->format("Y-m-d");
    $currentDate = $currentTime->format("Y-m-d");

    $hour = $currentTime->format("H");


    if ($hour >= 17 && $chosenDate <= $currentDate) {
        $dateError = "Invalid date chosen (Can't go back in time).";
        array_push($errors, $dateError);
    }

    if (count($errors) == 0) {
        $query = "INSERT INTO booking (name, surname, email, Pnumber, bookedDate, time, reason, dateOfBooking) 
                VALUES('$name', '$surname','$email','$number', '$chosenDate', '$time', '$reason', '$currentDate')";
        mysqli_query($db, $query);

        $_SESSION['booking_msg'] = "Succesfully booked a meeting!";
        header("Location: home.php");
    }
}
