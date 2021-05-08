<?php
require_once("../db/db_connect.php"); 


if (isset($_POST['date']) && isset($_POST['book']) == null) {
    $custom_date = $_POST['date'];

    
    $dateTime_query = "SELECT time FROM booking WHERE bookedDate = '$custom_date'";
    $day = new dateTime("today");
    $day = $day->format('Y-m-d');

    $dayOfWeek = date("l", strtotime($custom_date));

    $_SESSION['sessCustomDate'] = $custom_date;
    $start = new DateTime("$custom_date 9:00:00");
    $end   = new DateTime("$custom_date 18:00:00");
    $interval = new DateInterval('PT1H');
    $period   = new DatePeriod($start, $interval, $end);

        
    $used_times = array();
    $unused_times = array();

    $result = $db->query($dateTime_query);
    // If any results were found.
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
        array_push($used_times, $row["time"]);
        }
    }// If no results were found. 
    else {
        $query_results = "No Results";
        foreach ($period as $time) { 
            $result = $time->format('H:i A');
            array_push($unused_times, $result);
        }
    }

    // If results were found loop throught the arrays and check which hours were occupied.
    if (!isset($query_results)) {
        foreach ($period as $time) {
            $per_time = $time->format('H:i:s');
            if (!in_array($per_time, $used_times)) {
                $unused_time = $time->format('H:i A');
                array_push($unused_times, $unused_time);
            }

        }
    }


    echo "<p>Please select the time below.</p>";
    echo "<p> Displaying the times for:</p>";
    echo "<span>" . $custom_date . " - " . " $dayOfWeek" . "</span>";
    echo "<ul id=\"time-list\">";
    foreach($unused_times as $key=>$val){
        echo "<li id='$val'>" . $val . "</li>";
    }
    echo "</ul>";

    

} else {


    $current_time    = new DateTime('now');

    $hour = $current_time->format('H');
    $minutes = $current_time->format("i");
    $day = $current_time->format("Y-m-d");

    $dayOfWeek = date("l", strtotime($day));


    if ($dayOfWeek == "Saturday" || $dayOfWeek == "Sunday") {
        $start = new DateTime("next monday 9:00:00");
        $end   = new DateTime("next monday 18:00:00");
    }else {
        if ($minutes >= 0) {
            
            $hour ++;
            $minutes = 0;

            if ($hour >= 17 && $dayOfWeek == "Friday") {
                $start = new DateTime("next monday 9:00:00");
                $end   = new DateTime("next monday 18:00:00");
            } elseif ($hour >= 17) {
                $start = new DateTime("tomorrow 9:00:00");
                $end   = new DateTime("tomorrow 18:00:00");
            } elseif ($hour <= 9) {
                $start = new DateTime("today 9:00:00");
                $end   = new DateTime("today 18:00:00");
            } else {
                $start = new DateTime("today $hour:$minutes"); 
                $end   = new DateTime("today 18:00:00");
            }
        
        }
    }

    

    
    $interval = new DateInterval('PT1H');
    $period   = new DatePeriod($start, $interval, $end);

    $day = $start->format('Y-m-d');
        
    $_SESSION['disp_date'] = $day;
    $_SESSION['showing_day'] = date("l", strtotime($day));

    $dateTime_query = "SELECT time FROM booking WHERE bookedDate = '$day'";


    $used_times = array();
    $unused_times = array();


    $result = $db->query($dateTime_query);
    // If any results were found.
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            array_push($used_times, $row["time"]);
        }
    } // If no results were found.
    else { 
        $query_results = "No Results";
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

    

   



