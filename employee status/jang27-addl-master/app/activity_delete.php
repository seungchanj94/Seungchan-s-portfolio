<?php
$DATABASE_HOST="db.sice.indiana.edu"; // Host name
$DATABASE_USER="i495u20_jang27"; // Mysql username
$DATABASE_PASS="my+sql=i495u20_jang27"; // Mysql password
$DATABASE_NAME="i495u20_jang27"; // Database name
$tbl_name="employee"; // Table name

// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

$activity_id = mysqli_real_escape_string($con, $_POST['id']);
if (mysqli_connect_errno()) {
    // If there is an error with the connection, stop the script and display the error.
    die ('Failed to connect to MySQL: ' . mysqli_connect_error());
    echo "Failed to connect to MySQL";
}
// Check connection
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}
$result = mysqli_query($con,"DELETE FROM emp_activity WHERE activityid=$activity_id");

$result = mysqli_query($con,"DELETE FROM activity_log WHERE id=$activity_id");

echo 'Success';

mysqli_close($con);

?>