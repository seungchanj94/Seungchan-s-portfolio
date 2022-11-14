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




$matchoutput = mysqli_query($con,"SELECT * FROM sport_match");

while($result = mysqli_fetch_assoc($matchoutput)) {

    $name = $result['create_by'];


    echo '<div class="match">';
    echo '<h3>Event ID#: ' .$result['event_id']. '</h3>';
    echo '<h3>Title: ' .$result['event_title']. '</h3>';
    echo '<p> <b>Sport Type: </b> ' .$result['sport_type']. '</p>';
    echo '<h4>Description:</h4><p> ' .$result['description']. '</p>';
    echo ' <b>Location:</b> <p> <a href="https://www.latlong.net/c/?lat='.$result['latitute'].'&long='.$result['longtitute'].'" target="_blank">' .$result['location']. '</a></p>';
    echo '<p> <b>Date: </b> ' .$result['event_date']. '</p>';
    echo '<p id="create_event_user">Create by user# :'.$result['create_by'].'</p>';
    echo '<h4>Map Location:</h4>';
    echo '<a href="http://maps.google.com/maps?q='.$result['latitute'].','.$result['longtitute'].'&ll='.$result['latitute'].','.$result['longtitute'].'&z=17" target="_blank"> <p class="show_google_map"> show location on google map </p></a>';

    //echo '<p> <h6 id="lat">'.$result['latitute'].'</h6><h6 id="long">'.$result['longtitute'].'</h6></p>';
    //echo '<div id="map"></div>';
    // echo '<script src="js/show_map.js"></script>';
    // echo ' <script async defer
    //    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDrdXarrKH8QkRd8Hgsr84zOWArIVcOnCU&callback=initMap">
    //    </script>';


    // echo '<p> <b>Create By:</b> '.  $name .'</p>';


    echo '
        <button class="match_submit_button" value="'.$result['event_id'].'" type="button" name="match_button" id="match_button" onclick="openJoin()">Join</button>';
    echo '</div>';



}




mysqli_close($con);
 ?>
