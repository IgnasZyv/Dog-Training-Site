<?php
session_start();

$hostName = "localhost";
$username = "root";
$dbName = "cwwebsite";
$password = "";

$db = mysqli_connect($hostName, $username, $password, $dbName);

if (!$db) {
    die("Connection Failed: " . mysqli_connect_error());
}

