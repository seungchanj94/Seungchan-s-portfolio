<?php
session_start();

$var_username= "";
$var_email = "";

$errors = array();

$con = mysqli_connect("db.soic.indiana.edu","i494f19_jang27","my+sql=i494f19_jang27","i494f19_jang27");


if (isset($_POST['newAccount'])) {
	$var_username = mysqli_real_escape_string($con, $_POST['username']);
	$var_password = mysqli_real_escape_string($con, $_POST['password']);
	$var_confirmpw = mysqli_real_escape_string($con, $_POST['confirmpw']);
	$var_email = mysqli_real_escape_string($con, $_POST['email']);
	$var_firstname = mysqli_real_escape_string($con, $_POST['firstname']);
	$var_newAccount = mysqli_real_escape_string($con, $_POST['newAccount']);

if (empty($var_username)) {array_push($errors, "Required"); }
if (empty($var_password)) {array_push($errors, "Required"); }
if (empty($var_email)) {array_push($errors, "Required"); }
if ($var_password != $var_confirmpw) {
	array_push($errors, "passwords should be same");
}
$check = "SELECT * FROM Account Where username ='$var_username' OR email = '$var_eamil' limit 1";
$result = mysqli_query($con, $check);
$user = mysqli_fetch_assoc($result);

if ($user) {
	if ($user['username'] === $var_username) {
		array_push($errors, "The username is already exists");
}
	if ($user['email'] === $var_email) {
		array_push($errors, "The email is already exists");


	}
}

if (count($erros)==0) {
	$password = md5($var_password);

	$query = "insert into Account (username, password, email, firstname)
	values ('$var_username', '$password', '$var_email', '$var_firstname')";

	mysqli_query($con, $query);
	header('location: itp5.php');
	echo "Account created";
}

}

if (isset($_POST['loginbttn'])) {
	$var_username = mysqli_real_escape_string($con, $_POST['userid']);
	$var_password = mysqli_real_escape_string($con, $_POST['pw']);

	if (empty($var_username)) {
		array_push($errors, "required username");
	}
	if (empty($var_password)) {
		array_push($errors, "required password");
	}

	if (count($errors) == 0) {
		$var_password = md5($var_password);
		$query = "select * from Account where username = '$var_username' AND password='$var_password'";
		$results = mysqli_query($con, $query);
		if (mysqli_num_rows($results) == 1) {
			$_SESSION['username'] = $var_username;
			$_SESSION['success'] = "logged in";
			header('location: itp5_main.php');
		}
	else {
		array_push($errors, "It is wrong username and password");
					header('location: itp5_main.php');
	}
	}
}
?>