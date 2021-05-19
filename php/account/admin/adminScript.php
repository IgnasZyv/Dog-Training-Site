<?php

require_once("../../../db/db_connect.php");


// If booking id is recieved from the js ajax request
if (isset($_POST['bookingID'])) {
    // Store that id recieved
    $bookingId = $_POST['bookingID'];
    // Query to delete the booking from the database with that id
    $delQuery = "DELETE FROM booking WHERE id = $bookingId";

    // query returns true if successfull and false if not
    if ($db->query($delQuery) === TRUE) {
        // echo 
        echo "success";
    } else {
        echo "error";
    }


} 

if (isset($_POST['userId'])) {
    // Store email recieved
    $id = $_POST['userId'];
    
    // Query to delete the user from the database with that email
    $delEmail = "DELETE FROM users WHERE user_id = $id";

    // query returns true if successfull and false if not
    if ($db->query($delEmail) === TRUE) {
        
        echo "success";
    } else {
        // echo "error";
        echo $id;
    }


} 

