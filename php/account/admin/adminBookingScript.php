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


} else {

    $bookingQuery = "SELECT * FROM booking ORDER BY bookedDate, time  ASC";

    $result = mysqli_query($db, $bookingQuery);

    $bookingRows = array();

    // $date = new dateTime("now");
    // $currentDate = $date->format('Y-m-d');

    $passedBookings = array();
    $comingBookings = array();


    if ($result->num_rows > 0) {
    // output data of each row
        while($row = $result->fetch_assoc()) {

            if (new dateTime($row['bookedDate']) >= new dateTime()) {
                array_push($comingBookings, $row);

            }
        }
    }

}

