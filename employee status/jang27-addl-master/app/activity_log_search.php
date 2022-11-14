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
$emp_email = mysqli_real_escape_string($con, $_GET['email']);
$start_datetime = mysqli_real_escape_string($con, $_GET['startDatetime']);
$end_datetime = mysqli_real_escape_string($con, $_GET['endDatetime']);

$queryString = " select emp.id as employeeId, emp.email, emp.first_name, emp.last_name, emp.phone, emp.active, al.id as activityId, al.start_datetime, al.end_datetime from employee emp, emp_activity ea, activity_log al WHERE emp.id = ea.empid AND ea.activityid = al.id";
$activityLogs = "";


if (empty($emp_id) && empty($emp_email) && empty($start_datetime) && empty($end_datetime)) {
	
} else {
	if(!empty($emp_id)) {
		$queryString = $queryString." AND emp.id = $emp_id";
	}
	
	if(!empty($emp_email)) {
		$queryString = $queryString." AND emp.email = '$emp_email'";
	}
	
	if(!empty($start_datetime) && !empty($end_datetime)) {
		$queryString = $queryString." AND al.start_datetime BETWEEN '$start_datetime' AND '$end_datetime'";
		$queryString = $queryString." AND al.end_datetime BETWEEN '$start_datetime' AND '$end_datetime'";
	}
}

$activityLogs = mysqli_query($con,$queryString);

$result = array();

while($row = mysqli_fetch_array($activityLogs)) {
	array_push($result, array('empId'=>$row[0], 'email'=>$row[1], 'firstName'=>$row[2],'lastName'=>$row[3], 'phone'=>$row[4], 'active'=>$row[5],'activityId'=>$row[6],'startDatetime'=>$row[7], 'endDatetime'=>$row[8]));
}
echo json_encode(array("result"=>$result),JSON_UNESCAPED_UNICODE);

mysqli_close($con);
 ?>
