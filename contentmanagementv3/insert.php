<!DOCTYPE html>
<HTML>
<head>
	<title></title>
</head>

<body>

<h1> Insert Record </h1>
	
<?php 

$servername = "localhost";
$username = "115696";
$password = "saltaire";
$dbname = "115696";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
	die("Connection Failed: " . mysqli_connect_error());
}


$sql = "INSERT INTO contacts (name, email) VALUES ('john', 'john@example.com')";

if (mysqli_query($conn, $sql)) {
	echo "New Record Created";
} else {
	echo "Error:" . $sql . "<br>" . mysqli_error($conn);
}




mysql_close($conn);


?>

</body>   

</html>