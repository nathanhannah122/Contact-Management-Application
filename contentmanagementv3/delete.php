<?php
// Start the session
session_start();
?>


<!DOCTYPE html>
<HTML>
<head>
	<title></title>
</head>

<body>

<h1>Delete Record </h1>
	
<?php 

// if they are not logged in, exit.
if ($_SESSION["status"] == 'loggedInAdmin') {
	echo '<br><br>';
} else {
	exit('<br><br><br><br>You need to be logged in before you can view users.');
	header("location: userlist.php");
}

$servername = "localhost";
$username = "user";
$password = "********";
$dbname = "contacts";
// Start the session
session_start();

$rowID = $_POST['deletebtn'];
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
	die("Connection Failed: " . mysqli_connect_error());
}


$sql = "DELETE FROM contacts WHERE contactid='" . $rowID . "';";

if (mysqli_query($conn, $sql)) {
  echo "Record deleted successfully";
  header("location: userlist.php");

} else {
  echo "Error deleting record: " . mysqli_error($conn);
}


mysql_close($conn);
header("location: userlist.php");

?>

</body>   

</html>
