<?php

require_once("../../db/db_connect.php");



if (isset($_POST['bookingID'])) {

    $bookingId = $_POST['bookingID'];

    $delQuery = "DELETE FROM booking WHERE id = $bookingId";

    if ($db->query($delQuery) === TRUE) {
        // send back a JSON 
        echo "status";
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

