

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


        $account_id .= '<p id="account_id"> Your User ID: '.$userData['id'].'</p>';

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
    <title>Inviter</title>

    <link rel="stylesheet" type="text/css" href="css/normalize.css">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
        integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
        crossorigin=""/>
    <!-- Font Awesome-->
	<script src="https://kit.fontawesome.com/3680edfbdb.js" crossorigin="anonymous"></script>
	<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

</head>

<body>

        <!-- navigation bar  -->
        <div id="tag"></div>
        <section class="menu_section">
            <!-- NAVIGATION -->
            <nav id="mySidenav" class="sidenav">
                <a class="closebtn">&times;</a>
                <a href="index.php">Home</a>
                <a href="createevent.php">Create Match</a>
                <a href="search.php">Search</a>
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
			<h1>Create Event</h1>
			<!-- create match from database  -->
            <form class="" action="event_form.php" method="post">

                <h3>Event Title:</h3>
                <input type="text" id="event_title" name="event_title">

                <label> Type of Event:</label>
                <input type="radio" id="soccer" name="sport_type" value="soccer">
                <label for="male">soccer</label>
                <input type="radio" id="badminton" name="sport_type" value="badminton">
                <label for="female">badminton</label>
                <input type="radio" id="others" name="sport_type" value="others">
                <label for="other">Other</label><br><br>

                <label>Description:</label>
                <input class="event_description" type="text" id="event_description" name="event_description"><br><br>

                <label>Location:</label>
                <input class="event_location" type="text" id="event_location" name="event_location">

                <label>Date:</label>
                <input type="date" id="event_date" name="event_date">
				<br>
				<label>Latitude & Longitude:</label>
                <input type="text" id="latitude" name="latitude" placeholder="Latitude">
				<input type="text" id="longitude" name="longitude" placeholder="Latitude">

                <!-- get id of who create  -->
                <?php echo $account_id; ?>
                <label>Type User ID to confirm:</label>
                <input type="number" id="account_ide" name="account_id">


                <br><br><input class="submit" type="submit" value="Submit" onclick="openForm()">

            </form>

		</div>
		<!-- Google Map Search  -->
		<div class="container">
		<h3>Enter Location to check location and Latitude,Longitude</h3>
	      <h4 id="text-center">Enter Location: </h4>
	      <form id="location-form">
	        <input type="text" id="location-input" class="form-control form-control-lg">
	        <br>
	        <button type="submit" class="btn btn-primary btn-block">check</button>
	      </form>
		  <h5>Address from Google Map</h5>
	      <div class="card-block" id="formatted-address"></div>
		  <h5>Latitude & Longitude: </h5>
	      <div class="card-block" id="geometry"></div>
	    </div>


	    <script>
	      // Call Geocode
	      //geocode();

	      // Get location form
	      var locationForm = document.getElementById('location-form');

	      // Listen for submiot
	      locationForm.addEventListener('submit', geocode);

	      function geocode(e){
	        // Prevent actual submit
	        e.preventDefault();

	        var location = document.getElementById('location-input').value;

	        axios.get('https://maps.googleapis.com/maps/api/geocode/json',{
	          params:{
	            address:location,
	            key:'AIzaSyDrdXarrKH8QkRd8Hgsr84zOWArIVcOnCU'
	          }
	        })
	        .then(function(response){
	          // Log full response
	          console.log(response);

	          // Formatted Address
	          var formattedAddress = response.data.results[0].formatted_address;
	          var formattedAddressOutput = `
	            <ul class="list-group">
	              <li class="list-group-item">${formattedAddress}</li>
	            </ul>
	          `;

	          // Geometry
	          var lat = response.data.results[0].geometry.location.lat;
	          var lng = response.data.results[0].geometry.location.lng;
	          var geometryOutput = `
	            <ul class="list-group">
	              <li class="list-group-item"><strong>Latitude</strong>: ${lat}</li>
	              <li class="list-group-item"><strong>Longitude</strong>: ${lng}</li>
	            </ul>
	          `;

	          // Output to app
	          document.getElementById('formatted-address').innerHTML = formattedAddressOutput;
	          document.getElementById('geometry').innerHTML = geometryOutput;
	        })
	        .catch(function(error){
	          console.log(error);
	        });
	      }
	    </script>


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

    <script src="js/nav.js"></script>
    <script src="js/nav.js"></script>
    <script src="js/leaflet.js"></script>


</body>

</html>
