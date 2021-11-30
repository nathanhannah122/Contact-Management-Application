<?php 

$servername = "localhost";
$username = "115696";
$password = "saltaire";
$dbname = "115696";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
	die("Connection Failed: " . mysqli_connect_error());
}

$sql = "SELECT userid FROM users WHERE userid='nathan' AND password='123'";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
	while($row = mysqli_fetch_assoc($result)) {
		echo $row["userid"] . ", " . $row["password"] . "<br>";
	}
} else {
	echo "0 Results Found!";
}




mysql_close($conn);


?>