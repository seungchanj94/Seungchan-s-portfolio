

<?php
// Include configuration file
require_once 'config.php';

// Include User library file
require_once 'User.class.php';


if(isset($_GET['code'])){
	$gClient->authenticate($_GET['code']);
	$_SESSION['token'] = $gClient->getAccessToken();
	header('Location: ' . filter_var(GOOGLE_REDIRECT_URL, FILTER_SANITIZE_URL));
}

if(isset($_SESSION['token'])){
	$gClient->setAccessToken($_SESSION['token']);
}

if($gClient->getAccessToken()){
	// Get user profile data from google
	$gpUserProfile = $google_oauthV2->userinfo->get();

	// Initialize User class
	$user = new User();

	// Getting user profile info
	$gpUserData = array();
	$gpUserData['oauth_uid']  = !empty($gpUserProfile['id'])?$gpUserProfile['id']:'';
	$gpUserData['first_name'] = !empty($gpUserProfile['given_name'])?$gpUserProfile['given_name']:'';
	$gpUserData['last_name']  = !empty($gpUserProfile['family_name'])?$gpUserProfile['family_name']:'';
	$gpUserData['email'] 	  = !empty($gpUserProfile['email'])?$gpUserProfile['email']:'';
	$gpUserData['gender'] 	  = !empty($gpUserProfile['gender'])?$gpUserProfile['gender']:'';
	$gpUserData['locale'] 	  = !empty($gpUserProfile['locale'])?$gpUserProfile['locale']:'';
	$gpUserData['picture'] 	  = !empty($gpUserProfile['picture'])?$gpUserProfile['picture']:'';

	// Insert or update user data to the database
    $gpUserData['oauth_provider'] = 'google';
    $userData = $user->checkUser($gpUserData);

	// Storing user data in the session
	$_SESSION['userData'] = $userData;

	// Render user profile data
    if(!empty($userData)){
        $output	 = '<h2>Account Details</h2>';
		$output .= '<div class="ac-data">';
        $output .= '<img src="'.$userData['picture'].'">';
        $output .= '<p><b>Name:</b> '.$userData['first_name'].' '.$userData['last_name'].'</p>';
        $output .= '<p><b>Email:</b> '.$userData['email'].'</p>';
        $output .= '<p><b>Locale:</b> '.$userData['locale'].'</p>';
        $output .= '<p><b>Logged in with:</b> Google Account</p>';
		$output .= '</div>';
    }else{
        $output = '<h3 style="color:red">Some problem occurred, please try again.</h3>';
    }
}else{
	// Get login url
	$authUrl = $gClient->createAuthUrl();

	// Render google login button
	$output = '<a href="'.filter_var($authUrl, FILTER_SANITIZE_URL).'"><img src="images/google-sign-in-btn.png" alt=""/></a>';
}
?>



<!-- HTML PART  -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Search Player Result</title>

    <link rel="stylesheet" type="text/css" href="css/normalize.css">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
        integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
        crossorigin=""/>
    <!-- Font Awesome-->
	<script src="https://kit.fontawesome.com/3680edfbdb.js" crossorigin="anonymous"></script>
</head>

<body>

        <!-- navigation bar  -->
        <div id="tag"></div>
    <section class="menu_section">
        <!-- NAVIGATION -->
        <nav id="mySidenav" class="sidenav">
            <a class="closebtn">&times;</a>
			<a href="index.php">Home</a>
			<a href="search.php">Search</a>
			<a href="createevent.php">Create Match</a>
			<a href="matchhistory.php">Match History</a>
            <a href="logout.php">Sign Out</a>
        </nav>

        <div class="openbtn">
            <i class="fas fa-bars fa-2x"></i> <!--Menu Icon-->
            <span class="menu-text">menu</span>
        </div>
        <div class="all-over-bkg"></div>
        <header>
			<a href="http://cgi.sice.indiana.edu/~team19/team-19/app/login/index.php"><img src="images/Inviter_logo.png" alt="Inviter Logo" style="width:300px;"></a><!--Logo Part -->
        </header>
    </section>
	<h1></h1>
		<!-- use flex display  -->
		<div class="side_section">
		<div class="flexcontainer">

        <!-- Info of personal profile from Google  -->
        <div class="wrapper">
            <!-- Display login button / Google profile information -->
            <?php echo $output; ?>
        </div>

		<!-- Event page section  -->
		<div class="match_list">

			<h1>Match Result:</h1>

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
                echo "Failed to connect to MySQL";
            }


            $search = mysqli_real_escape_string($con, $_POST['search2']);
            $search_type = mysqli_real_escape_string($con, $_POST['search_type']);

            if (!isset($_POST['search2'])) {
               // Could not get the data that should have been sent.
               die ('Fill out thr search and submit to see result');
            }

            $matchoutput = mysqli_query($con,"SELECT * FROM account WHERE $search_type LIKE '%$search%'");

            $rowcount = mysqli_num_rows($matchoutput);

            if($rowcount >= 1){ // if one or more rows are returned do following

                while($result = mysqli_fetch_array($matchoutput)){


                echo '<div class="match">';
                echo '<img class="search_result" src="'.$result['picture'].'">';
                echo '<p><b>Name:</b> '.$result['first_name'].' '.$result['last_name'].'</p>';
                echo '<p><b>Email:</b> '.$result['email'].'</p>';
				echo '<p><b>USer ID:</b> '.$result['id'].'</p>';
                echo '
                    <button class="match_submit_button"type="button" name="match_button">Message person</button>';
                echo '</div>';
            }




                }
            else {
               echo '<h3> No Result</h3>';
            }


            mysqli_close($con);



			 ?>
		</div>
		</div>
		<div class="message">
			<form method="post">
				<h2>Messager</h2>
				<h4>Type in user# You want to send email to: </h4><br>
				<input type="text" name="user_number" id="user_number" placeholder="Type Host user# here" required>
				<?php
					echo '<h4 id="user_email"><b>from: </b>'.$userData['email'].'</h4>';
				 ?>

				 <p>Messege to user: </p><br>
				 <input type="text" name="message_text" id="message_text" placeholder="Type your Messege here" required>
				 <button type="submit" name="submit_message" >Submit Message for Review</button>
				 <button type="button" name="submit_message" onclick="openForm()">Confirm Message & Send</button>
				 <!-- <button type="button" name="exit_message" onclick="closeForm()">Exit from message</button> -->
			</form>
		</div>

		<!-- popup to confrim message email -->
		<div class="login-popup">
		<div class="form-popup" id="popupForm">
			<form medthod="post">
			<?php include('message_host.php'); ?>
				<h2>Messager</h2>
				<h4>To: <?php  echo $host_email; ?></h4> <br>
				<h4>from: <?php echo $userData['email']; ?> </h4><br>
				<h4>Message: <?php echo $get_message; ?> </h4><br>
				 <?php
					$to = $host_email;
					$subject = 'Message from Inviter';
					$message = $get_message;
					$from = $userData['email'];

					// Sending email
					if(mail($to, $subject, $message)){
					 echo '<h1>Your mail has been sent successfully.</h1>';
					} else{
					 echo '<h1>Unable to send email. Please try again.</h1>';
					}

				  ?>
				 <button type="button" name="exit_message" onclick="closeForm()">Exit from Conffirm</button>

				 <!-- <button type="button" name="exit_message" onclick="closeForm()">Exit from message</button> -->
			</form>
		</div>
	</div>
	</div>

	<div class="connect">
		<h2>  Connect with Us <img src="images/Inviter_logo_only.png" alt="Inviter Logo" style="width:100px;">  </h2>
	</div>
	<footer>
		<a href="https://www.facebook.com/"><i class="fab fa-facebook fa-2x" style="color:rgb(255, 255, 255);"></i></a>

		<a href="https://twitter.com/explore"><i class="fab fa-twitter fa-2x" style="color:rgb(255, 255, 255);"></i></a>

		<a href="https://www.instagram.com/"><i class="fab fa-instagram fa-2x" style="color:rgb(255, 255, 255);"></i></a>
	</footer>



<!-- JAVASCRIPT -->

<script src="js/nav.js"></script>
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
 		integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
		 crossorigin="">
</script>
<script src="js/nav.js"></script>
<script src="js/leaflet.js"></script>
<script>



	<script>
	  function openForm() {
		document.getElementById("popupForm").style.display="block";
	  }

	  function closeForm() {
		document.getElementById("popupForm").style.display="none";
	  }

	  function openJoin() {
	    document.getElementById("popupJoin").style.display="block";
	  }

	  function closeJoin() {
	   document.getElementById("popupJoin").style.display="none";
	  }
	</script>
</body>

</html>
