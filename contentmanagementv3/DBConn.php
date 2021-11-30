<?php
//
// Get database connection
//
function getDBConnection() {
	// get connection to MySQL database
	$servername = "localhost";
	$username = "user";
	$password = "******";
	$dbname = "contacts";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn) {
	  die("Connection failed: " . mysqli_connect_error());
	}
	return $conn;
}
?>
