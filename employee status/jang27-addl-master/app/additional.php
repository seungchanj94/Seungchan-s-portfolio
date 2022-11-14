<?php



$conn = mysqli_connect("db.soic.indiana.edu","i494f19_jang27","my+sql=i494f19_jang27","i494f19_jang27");


if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>