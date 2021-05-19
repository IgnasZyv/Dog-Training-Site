<?php
session_start();

$hostName = "localhost";
$username = "root";
$dbName = "cwwebsite";
$password = "";
// Establish the connection wiht cwwebsite database
$db = mysqli_connect($hostName, $username, $password, $dbName);

if (!$db) {
    die("Connection Failed: " . mysqli_connect_error());
}


