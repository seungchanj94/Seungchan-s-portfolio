<?php

$DATABASE_HOST="db.sice.indiana.edu"; // Host name
$DATABASE_USER="i494f19_team19"; // Mysql username
$DATABASE_PASS="my+sql=i494f19_team19"; // Mysql password
$DATABASE_NAME="i494f19_team19"; // Database name
$tbl_name="users"; // Table name

$db = mysqli_connect($DATABASE_HOST,$DATABASE_USER,$DATABASE_PASS,$DATABASE_NAME);

// Check connection
if($db === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}


 ?>
