<?php
session_start();

date_default_timezone_set('Asia/Manila');

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'sasad_pharmacy');

$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($con === false)
{
    die("ERROR: Could not Connect to the Database." . mysqli_connect_error());
}
?>