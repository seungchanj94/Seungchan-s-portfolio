<?php
$DATABASE_HOST="db.sice.indiana.edu"; // Host name
$DATABASE_USER="i494f19_team19"; // Mysql username
$DATABASE_PASS="my+sql=i494f19_team19"; // Mysql password
$DATABASE_NAME="i494f19_team19"; // Database name
$tbl_name="sport_match"; // Table name

// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	// If there is an error with the connection, stop the script and display the error.
	die ('Failed to connect to MySQL: ' . mysqli_connect_error());
}

// Now we check if the data was submitted, isset() function will check if the data exists.
if (!isset($_POST['event_title'])) {
	// Could not get the data that should have been sent.
	die ('Please complete the form! (Could not get the data from event title)');
}

if (!isset($_POST['sport_type'])) {
	// Could not get the data that should have been sent.
	die ('Please complete the form! (Could not get the data from event type)');
}

if (!isset($_POST['account_id'])) {
	// Could not get the data that should have been sent.
	die ('Please complete the form! (Could not get the data from account id)');
}


$event_title = mysqli_real_escape_string($con, $_POST['event_title']);
$event_type = mysqli_real_escape_string($con, $_POST['sport_type']);
$event_description = mysqli_real_escape_string($con, $_POST['event_description']);
$event_location = mysqli_real_escape_string($con, $_POST['event_location']);
$event_date = mysqli_real_escape_string($con, $_POST['event_date']);
$event_userId = mysqli_real_escape_string($con, $_POST['account_id']);
$event_lat = mysqli_real_escape_string($con, $_POST['latitude']);
$event_long = mysqli_real_escape_string($con, $_POST['longitude']);


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
		$query = "INSERT INTO sport_match (event_title, sport_type, description, location, event_date,create_by,latitute,longtitute)
  			  VALUES('$event_title', '$event_type','$event_description', '$event_location',  '$event_date','$event_userId','$event_lat','$event_long')";
  	    mysqli_query($con, $query);
		header("Location: index.php");
        }

	$stmt->close();



 ?>
