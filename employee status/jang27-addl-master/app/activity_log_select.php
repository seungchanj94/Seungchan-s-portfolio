<?php

$DATABASE_HOST="db.sice.indiana.edu"; // Host name
$DATABASE_USER="i495u20_jang27"; // Mysql username
$DATABASE_PASS="my+sql=i495u20_jang27"; // Mysql password
$DATABASE_NAME="i495u20_jang27"; // Database name
$tbl_name="employee"; // Table name

// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    // If there is an error with the connection, stop the script and display the error.
    die ('Failed to connect to MySQL: ' . mysqli_connect_error());
    echo "Failed to connect to MySQL";
}

$emp_id = mysqli_real_escape_string($con, $_GET['id']);

$activityLogs = mysqli_query($con,"SELECT * FROM emp_activity a, activity_log b WHERE a.activityid = b.id AND a.empid = $emp_id");

$result = array();

while($row = mysqli_fetch_array($activityLogs)) {
	array_push($result, array('empId'=>$row[0],'activityId'=>$row[1], 'id'=>$row[2], 'startDatetime'=>$row[3],'endDatetime'=>$row[4],'note'=>$row[5]));
}
echo json_encode(array("result"=>$result),JSON_UNESCAPED_UNICODE);

mysqli_close($con);
 ?>
