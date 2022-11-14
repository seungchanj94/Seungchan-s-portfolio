
<?php

    include("config.php");
    session_start();

        // Prepare our SQL, preparing the SQL statement will prevent SQL injection.
        if ($stmt = $db->prepare('SELECT id, password FROM users WHERE username = ?')) {
	    // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	       $stmt->bind_param('s', $_POST['myusername']);

           $stmt->execute();
	    // Store the result so we can check if the account exists in the database.
	       $stmt->store_result();

           if ($stmt->num_rows > 0) {
	              $stmt->bind_result($id, $password);
	              $stmt->fetch();
	             // Account exists, now we verify the password.
	            // Note: remember to use password_hash in your registration file to store the hashed passwords.
	              if ($_POST['mypassword']=== $password) {
		                    // Verification success! User has loggedin!
		                    // Create sessions so we know the user is logged in, they basically act like cookies but remember the data on the server.

                            $_SESSION['login_user'] = $_POST['myusername'];
                            header("location: profile.php");

	              } else {
		                    echo 'Incorrect password!';
	                       }
        } else {
	           echo 'Incorrect username!';
                }

	       $stmt->close();

       }


 ?>

<html lang="en" dir="ltr">

<head>
	<meta charset="utf-8">
	<title>Log in</title>
	<!-- Bootstrape css -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<!-- Bootstrape javascript -->
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</head>

<body>
	<div class="container" style="margin-top:100px">
		<div class="row justify-content-center">
            <div class="col-md-6 col-offset-3" align="center">
                <h1>Log in</h1>

    			<form action= "" method="post">
                    <input type="text" name="myusername" placeholder="Username" id="myusername" class="form-control" required ><br>
                    <input type="password" name="mypassword" placeholder="Password" id="mypassword" class="form-control" required><br>
                    <input type="submit" value=" Submit" class="btn btn-primary">
    			</form>
            </div>

		</div>

	</div>

</body>

</html>
