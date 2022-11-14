<!DOCTYPE html>
<html>
<body>
<h1>Additional Query: Students and Major</h1>
<h2>Select Major</h2>
<form action="selectMajor.php" method="POST">

Major  Name: <select name='major'>
<?php
$servername = "db.soic.indiana.edu";
$username = "i308s18_team65";
$password = "my+sql=i308s18_team65";
$database = "i308s18_team65";
$conn=mysqli_connect($servername,$username,$password, $database);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
   
    $result = mysqli_query($conn,"select majorName as name from Major;");
    while ($row = mysqli_fetch_assoc($result)) {
                  unset($id, $name);
                  $id = $row['name'];
                  $name = $row['name']; 
                  echo '<option value="'.$id.'">'.$name.'</option>';
}
?> 
    </select>

<br><br>

<input type="submit" value="select Major">
</form>

<p> When you choose Business, The result = 5 rows </p>
<p>Andrew Lauren, Hamton Narissa, Maynard Liam, Paul Kylie,Sharp Willow</p>

</body>

</html>