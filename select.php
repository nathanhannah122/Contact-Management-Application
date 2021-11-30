<!DOCTYPE html>
<HTML>
<head>
	<title></title>
</head>

<body>

<h1> Hello! </h1>
	
<?php 

$servername = "localhost";
$username = "115696";
$password = "saltaire";
$dbname = "115696";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
	die("Connection Failed: " . mysqli_connect_error());
}

$sql = "SELECT contactid, name, email FROM contacts";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
	while($row = mysqli_fetch_assoc($result)) {
		echo $row["contactid"] . ", " . $row["name"] . ", " . $row["email"] . "<br>";
	}
} else {
	echo "0 Results Found!";
}




mysql_close($conn);


?>

</body>   

</html>