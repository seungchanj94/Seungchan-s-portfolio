

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
    <title>Match History</title>

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
        <!-- Navigation Bar for all the pages -->
        <div id="tag"></div>
    <section class="menu_section">
        <!-- NAVIGATION -->
        <nav id="mySidenav" class="sidenav">
            <a class="closebtn">&times;</a>
            <a href="index.php">Home</a>
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
		<div class="flexcontainer">

        <!-- Info of personal profile from Google  -->
        <div class="wrapper">
            <!-- Display login button / Google profile information -->
            <?php echo $output; ?>
        </div>

		<!-- Event page section  -->
		<div class="match_list">
			<h1>Match History</h1>
			<!-- Adding match from database  -->
			<!-- <?php echo $matchoutput; ?> -->
		</div>
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
</body>

</html>
