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

$employeeoutput = mysqli_query($con,"SELECT * FROM employee");

$result = array();

while($row = mysqli_fetch_array($employeeoutput)) {
	array_push($result, array('id'=>$row[0],'email'=>$row[1],'firstName'=>$row[2],'lastName'=>$row[3],'phone'=>$row[4],'admin'=>$row[5],'active'=>$row[6]));
}
echo json_encode(array("result"=>$result),JSON_UNESCAPED_UNICODE);

mysqli_close($con);
 ?>
