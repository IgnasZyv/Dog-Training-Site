<?php
require_once("../db/db_connect.php"); 

// If recieved date variable from the ajax and the form was not submited
if (isset($_POST['date']) && isset($_POST['book']) == null) {
    // Save the date chosen by the user
    $custom_date = $_POST['date'];
    // Takes time from the database where the date is chosen by the user
    $dateTime_query = "SELECT time FROM booking WHERE bookedDate = '$custom_date'";
    // Creates a new DateTime object of today

    $day = new dateTime("today");
    // Format the todays date with the y-m-d format
    $day = $day->format('Y-m-d');
    // Takes the weekday from the custom date variable meaning date provided by the user
    $dayOfWeek = date("l", strtotime($custom_date));
    // Create session variable with the date provided
    $_SESSION['sessCustomDate'] = $custom_date;

    // Create a datetime object with the custom date but the time is 9am
    $start = new DateTime("$custom_date 9:00:00");
    // Same here except the time is 6pm
    $end   = new DateTime("$custom_date 18:00:00");
    // Interval of 1 hour
    $interval = new DateInterval('PT1H');
    // Created a time period between 9am to 6pm with 1 hour interval
    $period   = new DatePeriod($start, $interval, $end);

    // Arrays for used times and unused
    $used_times = array();
    $unused_times = array();

    // Make the time query
    $result = $db->query($dateTime_query);
    // If any results were found.
    if ($result->num_rows > 0) {
        // output data of each row into used times array
        while($row = $result->fetch_assoc()) {
        array_push($used_times, $row["time"]);
        }
    }// If no results were found. 
    else {
        // Set the variable so it doesn't fall into the next block of code
        $query_results = "No Results";
        // Because no times were used in the chosen date all of the period times are placed in unused times array
        foreach ($period as $time) { 
            $result = $time->format('H:i A');
            array_push($unused_times, $result);
        }
    }

    // In some times were found in the specified date
    if (!isset($query_results)) {
        // For every period entry
        foreach ($period as $time) {
            // Format the time into hours:minutes:seconds
            $per_time = $time->format('H:i:s');
            // if the period time is not in used times array
            if (!in_array($per_time, $used_times)) {
                // Format the period time into 24h format meaning it will be displayed as 15:00PM 
                $unused_time = $time->format('H:i A');
                // Add the time into unused times arrray
                array_push($unused_times, $unused_time);
            }

        }
    }

    // Echoes the following code for the ajax to place into booking page specific div which will update the time for the day seamlessly
    echo "<p>Please select the time below.</p>";
    echo "<p> Displaying the times for:</p>";
    echo "<span>" . $custom_date . " - " . " $dayOfWeek" . "</span>";
    echo "<ul id=\"time-list\">";
    // Creates a list of unused times in the same format as the booking.php file
    foreach($unused_times as $key=>$val){
        echo "<li id='$val'>" . $val . "</li>";
    }
    echo "</ul>";

    

} else {
    // This will run by default everytime the user enters the booking page

    // Take the curret time and day
    $current_time    = new DateTime('now');

    // Takes the current hour
    $hour = $current_time->format('H');
    // Takes current minute
    $minutes = $current_time->format("i");
    // Takes current day
    $day = $current_time->format("Y-m-d");

    // Takes the day of the week from the date frovided
    $dayOfWeek = date("l", strtotime($day));

    // If the current day is Satuday or Sunday
    if ($dayOfWeek == "Saturday" || $dayOfWeek == "Sunday") {
        // changes the current date into the closest monday
        $start = new DateTime("next monday 9:00:00");
        $end   = new DateTime("next monday 18:00:00");
    }else {

        // Adds 1 hour to the current hour
        $hour ++;
        // Sets the minutes to 0
        $minutes = 0;
        // If the hour is passed 17pm and the weekday is Friday
        if ($hour >= 17 && $dayOfWeek == "Friday") {
            // Display the times for the closest monday with the time specified
            $start = new DateTime("next monday 9:00:00");
            $end   = new DateTime("next monday 18:00:00");
        } 
        // If the hour is passed 1pm
        elseif ($hour >= 17) {
            // Show the times for tomorrow with the time specified
            $start = new DateTime("tomorrow 9:00:00");
            $end   = new DateTime("tomorrow 18:00:00");
        } 
        // if the hour is less than 9am
        elseif ($hour <= 9) {
            // Show todays date with the time specified
            $start = new DateTime("today 9:00:00");
            $end   = new DateTime("today 18:00:00");
        } else {
            // If the user is viewing the booking while the store is open display the available time to the closest hour
            $start = new DateTime("today $hour:$minutes"); 
            $end   = new DateTime("today 18:00:00");
        }
    
        
    }

    

    // Specify that the inverval is of 1 hour
    $interval = new DateInterval('PT1H');
    // Create the period of times from the time specified above
    $period   = new DatePeriod($start, $interval, $end);

    // Depending on what the start date is format that date so it's left with just the date of that time
    $day = $start->format('Y-m-d');
    // Create a session variable to display the date
    $_SESSION['disp_date'] = $day;
    // To show the current week day
    $_SESSION['showing_day'] = date("l", strtotime($day));

    // Check if any times are taken with the used date
    $dateTime_query = "SELECT time FROM booking WHERE bookedDate = '$day'";

    // Declare used times and unused times arrays
    $used_times = array();
    $unused_times = array();


    $result = $db->query($dateTime_query);
    // If any results were found.
    if ($result->num_rows > 0) {
        // output data of each row into used times array
        while($row = $result->fetch_assoc()) {
            array_push($used_times, $row["time"]);
        }
    } // If no results were found.
    else { 
        // Set the variable so it doesn't fall into the next block of code
        $query_results = "No Results";
        // Because no times were used in the specific date all of the period times are placed in unused times array
        foreach ($period as $time) {
            $result = $time->format('H:i A');
            array_push($unused_times, $result);
        }
    }

    // If results were found check which times were used.
    if (!isset($query_results)) {
        foreach ($period as $time) {
            $per_time = $time->format('H:i:s');
            // If times is not in used times array push that time in a new array.
            if (!in_array($per_time, $used_times)) {
                $unused_time = $time->format('H:i A');
                array_push($unused_times, $unused_time);
            }

        }
    }


    
}

    

   



