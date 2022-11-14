<?php
include("itp5_second.php")
?>

<!DOCTYPE html>
<html>
<head>
  <title>IPT 5 (Login to ITP 4) </title>
<style>

.register{
  border: 2px solid black;
  background-color: red;
  width: 200px;
  margin: auto;

}

.login {
  border: 2px solid black;
  background-color: green;
  width: 200px;
  margin: auto;
}
</style>

</head>
<form method = "POST" action="itp5_second.php">
	<?php include('errors.php'); ?>
  <div class = "register">
    <p> Create Your Account </p>
  <input name = "username" type="text" placeholder="Username" value=""/>
  <input name = "password" type="password" placeholder="Password" value=""/>
	<input name = "confirmpw" type="password" placeholder="Enter your password again" value=""/>
	<input name = "email" type="text" placeholder="Enter your email" value=""/>
	<input name = "firstname" type="text" placeholder="Enter your firstname" value=""/>
  <button name = "newAccount" type="submit" value="Make Account">Submit</button>
</div>
</form>
<br>

<form method = "POST" action="itp5_second.php">
	<?php include('errors.php'); ?>
  <div class = "login">
    <p> Login to Your Account </p>
  <input name = "userid" type="text" placeholder="Enter your username" value=""/>
  <input name = "pw" type="password" placeholder="Enter your password" value=""/>
  <button name = "loginbttn" type="submit" value="Login">Submit</button>
</div>
</form>


</body>

</html>