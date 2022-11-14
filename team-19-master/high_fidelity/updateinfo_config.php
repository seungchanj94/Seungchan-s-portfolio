<?php
include('session.php');

$DATABASE_HOST="db.sice.indiana.edu"; // Host name
$DATABASE_USER="i494f19_team19"; // Mysql username
$DATABASE_PASS="my+sql=i494f19_team19"; // Mysql password
$DATABASE_NAME="i494f19_team19"; // Database name
$tbl_name="users"; // Table name

// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	// If there is an error with the connection, stop the script and display the error.
	die ('Failed to connect to MySQL: ' . mysqli_connect_error());
}

session_start();

// receive all input values from the form
//$image = mysqli_real_escape_string($con, $_POST['image']);
//$sporttype = $_POST['sporttype']);

$sql = "UPDATE users SET sport_type='tennis' WHERE username='$user_check'";
mysqli_query($con, $sql);

header("Location: profile.php");


?>
