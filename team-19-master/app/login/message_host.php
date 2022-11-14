<?php
$DATABASE_HOST="db.sice.indiana.edu"; // Host name
$DATABASE_USER="i494f19_team19"; // Mysql username
$DATABASE_PASS="my+sql=i494f19_team19"; // Mysql password
$DATABASE_NAME="i494f19_team19"; // Database name
$tbl_name="account"; // Table name

// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    // If there is an error with the connection, stop the script and display the error.
    die ('Failed to connect to MySQL: ' . mysqli_connect_error());
    echo "Failed to connect to MySQL";
}


$get_host_id = mysqli_real_escape_string($con, $_POST['user_number']);
$get_message = mysqli_real_escape_string($con, $_POST['message_text']);
$message_form = mysqli_query($con,"SELECT email FROM account where id='$get_host_id'");



$result = mysqli_fetch_array($message_form);
$host_email = $result['email'];
