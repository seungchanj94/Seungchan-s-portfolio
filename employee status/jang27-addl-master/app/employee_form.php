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
}

// Now we check if the data was submitted, isset() function will check if the data exists.
if (!isset($_POST['email'])) {
	// Could not get the data that should have been sent.
	die ('Please complete the form! (Could not get the data from event title)');
}

if (!isset($_POST['first_name'])) {
	// Could not get the data that should have been sent.
	die ('Please complete the form! (Could not get the data from event type)');
}

if (!isset($_POST['last_name'])) {
	// Could not get the data that should have been sent.
	die ('Please complete the form! (Could not get the data from account id)');
}
if (!isset($_POST['phone'])) {
	// Could not get the data that should have been sent.
	die ('Please complete the form! (Could not get the data from account id)');
}
if (!isset($_POST['admin'])) {
	// Could not get the data that should have been sent.
	die ('Please complete the form! (Could not get the data from account id)');
}
if (!isset($_POST['active'])) {
	// Could not get the data that should have been sent.
	die ('Please complete the form! (Could not get the data from account id)');
}


$emp_userId = mysqli_real_escape_string($con, $_POST['id']);
$emp_email = mysqli_real_escape_string($con, $_POST['email']);
$emp_first_name = mysqli_real_escape_string($con, $_POST['first_name']);
$emp_last_name = mysqli_real_escape_string($con, $_POST['last_name']);
$emp_phone = mysqli_real_escape_string($con, $_POST['phone']);
$emp_admin = mysqli_real_escape_string($con, $_POST['admin']);
$emp_active = mysqli_real_escape_string($con, $_POST['active']);


// We need to check if the account with that username exists.
// first check the database to make sure
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM sport_match WHERE event_title='$event_title' LIMIT 1";
  $result = mysqli_query($con, $user_check_query);
  $user = mysqli_fetch_assoc($result);
	// Store the result so we can check if the account exists in the database.
	if ($user) { // if user exists
    	if ($user['event_title'] === $event_title) {
      		echo"event already exists";
    		}

  }
	 else {
		// Insert new event
        // Username doesnt exists, insert new account
		$query = "INSERT INTO employee (email, first_name, last_name, phone, admin, active)
  			  VALUES('$event_email', '$event_first_name','$event_last_name', '$event_phone', '$event_admin','$event_active')";
  	    mysqli_query($con, $query);
		header("Location: index.php");
        }

	$stmt->close();



 ?>
