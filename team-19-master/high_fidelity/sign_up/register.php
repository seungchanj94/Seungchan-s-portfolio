<?php

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
// Now we check if the data was submitted, isset() function will check if the data exists.
if (!isset($_POST['username'], $_POST['password'], $_POST['email'])) {
	// Could not get the data that should have been sent.
	die ('Please complete the registration form! (Could not get the data that should have been sent.)');
}
// Make sure the submitted registration values are not empty.
if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['firstname']) || empty($_POST['lastname']) || empty($_POST['repassword']) || empty($_POST['email'])) {
	// One or more values are empty.
	die ('Please complete the registration form(values are empty.)');
}

// receive all input values from the form
$username = mysqli_real_escape_string($con, $_POST['username']);
$firstname = mysqli_real_escape_string($con, $_POST['firstname']);
$lastname = mysqli_real_escape_string($con, $_POST['lastname']);
$email = mysqli_real_escape_string($con, $_POST['email']);
$password_1 = mysqli_real_escape_string($con, $_POST['password']);
$password =$password_1;
//$password = password_hash($password_1, PASSWORD_DEFAULT);

// Email Validation
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
	die ('Email is not valid!');
}

//Paword Validation
if (strlen($_POST['password']) > 20 || strlen($_POST['password']) <= 8) {
	die ('Password must be between 8 and 20 characters long and matched!');
}

//if pw does not match
if (strlen($_POST['password']) != strlen($_POST['repassword']) ) {
	die ('The two passwords do not match');
}


// We need to check if the account with that username exists.
// first check the database to make sure
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($con, $user_check_query);
  $user = mysqli_fetch_assoc($result);
	// Store the result so we can check if the account exists in the database.
	if ($user) { // if user exists
    	if ($user['username'] === $username) {
      		echo"Username already exists";
    		}

    	if ($user['email'] === $email) {
      		echo"email already exists";
    		}
  }
	 else {
		// Insert new account
        // Username doesnt exists, insert new account
		$query = "INSERT INTO users (username, password, firstname, lastname, email)
  			  VALUES('$username', '$password','$firstname', '$lastname',  '$email')";
  	    mysqli_query($con, $query);
		header("Location: http://cgi.soic.indiana.edu/~nrammasu/capstone/inviter/login.php");
        }

	$stmt->close();

?>
