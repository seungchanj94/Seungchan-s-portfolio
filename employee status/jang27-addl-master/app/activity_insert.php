<?php
$DATABASE_HOST="db.sice.indiana.edu"; // Host name
$DATABASE_USER="i495u20_jang27"; // Mysql username
$DATABASE_PASS="my+sql=i495u20_jang27"; // Mysql password
$DATABASE_NAME="i495u20_jang27"; // Database name
$tbl_name="employee"; // Table name

// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    // If there is an error with the connection, stop the script and display the error.
    die ('Failed to connect to MySQL: ' . mysqli_connect_error());
    echo "Failed to connect to MySQL";
}
$emp_id = mysqli_real_escape_string($con, $_POST['employeeId']);
$start_datetime = mysqli_real_escape_string($con, $_POST['startDatetime']);
$end_datetime = mysqli_real_escape_string($con, $_POST['endDatetime']);
$note = mysqli_real_escape_string($con, $_POST['note']);

$result = mysqli_query($con,"INSERT INTO activity_log (start_datetime, end_datetime, note)
VALUES('$start_datetime', '$end_datetime', '$note')");

$result = mysqli_query($con,"INSERT INTO emp_activity (empid, activityid) VALUES ($emp_id, LAST_INSERT_ID())");

echo "Success";

mysqli_close($con);

?>