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

$emp_id = mysqli_real_escape_string($con, $_POST['id']);
$emp_email = mysqli_real_escape_string($con, $_POST['email']);
$emp_first_name = mysqli_real_escape_string($con, $_POST['first_name']);
$emp_last_name = mysqli_real_escape_string($con, $_POST['last_name']);
$emp_phone = mysqli_real_escape_string($con, $_POST['phone']);
$emp_admin = mysqli_real_escape_string($con, $_POST['admin']);
$emp_active = mysqli_real_escape_string($con, $_POST['active']);


$result = mysqli_query($con,"UPDATE employee SET email='$emp_email', first_name='$emp_first_name', last_name='$emp_last_name', phone='$emp_phone', admin='$emp_admin', active='$emp_active' WHERE id=$emp_id");

echo 'Success';

mysqli_close($con);
 ?>
