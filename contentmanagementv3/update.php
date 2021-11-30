<!DOCTYPE html>
<HTML>
<head>
	<title></title>
</head>

<body>

<h1> Update Record </h1>
	
<?php 

$servername = "localhost";
$username = "user";
$password = "********";
$dbname = "contacts";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
	die("Connection Failed: " . mysqli_connect_error());
}



$sql = "UPDATE contacts SET name='nathanupdated' WHERE contactid=1";

if (mysqli_query($conn, $sql)) {
  echo "Record updated successfully";
} else {
  echo "Error updating record: " . mysqli_error($conn);
}


mysql_close($conn);


?>

</body>   

</html>
