<?php
$DATABASE_HOST="db.sice.indiana.edu"; // Host name
$DATABASE_USER="i495u20_jang27"; // Mysql username
$DATABASE_PASS="my+sql=i495u20_jang27"; // Mysql password
$DATABASE_NAME="i495u20_jang27"; // Database name

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

$emp_email = mysqli_real_escape_string($con, $_POST['email']);
$emp_first_name = mysqli_real_escape_string($con, $_POST['first_name']);
$emp_last_name = mysqli_real_escape_string($con, $_POST['last_name']);
$emp_phone = mysqli_real_escape_string($con, $_POST['phone']);
$emp_admin = mysqli_real_escape_string($con, $_POST['admin']);
$emp_active = mysqli_real_escape_string($con, $_POST['active']);

// Check connection
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "INSERT INTO employee (email, first_name, last_name, phone, admin, active)
VALUES('$emp_email', '$emp_first_name','$emp_last_name', '$emp_phone', '$emp_admin','$emp_active')";


if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }
  
echo "$emp_email";

mysqli_close($con);

?>