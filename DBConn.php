<?php
//
// Get database connection
//
function getDBConnection() {
	// get connection to MySQL database
	$servername = "localhost";
	$username = "115696";
	$password = "saltaire";
	$dbname = "115696";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn) {
	  die("Connection failed: " . mysqli_connect_error());
	}
	return $conn;
}
?>