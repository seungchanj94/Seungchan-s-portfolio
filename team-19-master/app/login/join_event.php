<?php
$DATABASE_HOST="db.sice.indiana.edu"; // Host name
$DATABASE_USER="i494f19_team19"; // Mysql username
$DATABASE_PASS="my+sql=i494f19_team19"; // Mysql password
$DATABASE_NAME="i494f19_team19"; // Database name
$tbl_name="account"; // Table name

// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    // If there is an error with the connection, stop the script and display the error.
    die ('Failed to connect to MySQL: ' . mysqli_connect_error());
    echo "Failed to connect to MySQL";
}

$get_event = mysqli_real_escape_string($con, $_POST['event_number']);

$event_information = mysqli_query($con,"SELECT * FROM sport_match where event_id='$get_event'");
$rowcount = mysqli_num_rows($event_information);

if($rowcount > 0){
    // $error = 'row found ';
    // $error .= 'number of row ='.$rowcount;
    $result = mysqli_fetch_array($event_information);
    $match_id = $result['event_id'];
    $match_title = $result['event_title'];
    $match_type = $result['sport_type'];
    $match_description = $result['description'];
    $match_location = $result['location'];
    $match_date = $result['event_date'];
    $message_array =array($match_id,$match_title,$match_type,$match_description,$match_location,$match_date);


}

else {
    $error = ' no row found';
}




 ?>
