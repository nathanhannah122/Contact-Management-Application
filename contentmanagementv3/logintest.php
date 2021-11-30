<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
?>

<?php
// Start the session
session_start();

// Get parameters from login page
$email    = $_POST['userid'];
$password2 = $_POST['password'];


$servername = "localhost";
$username = "115696";
$password = "saltaire";
$dbname = "115696";
$conn =mysqli_connect($servername,$username,$password,$dbname);

if (!$conn){
	die("Connection failed:".mysqli_connect_error());
}
//selecting what information we want
$sql = "SELECT id FROM users";
$sql = $sql . " where userid='" . $email . "' AND password='" . $password2 . "';";
$result = mysqli_query($conn, $sql);

echo $sql;

if (mysqli_num_rows($result) == 1) {
	$status = "loggedInAdmin";
	$_SESSION["status"] = $status;
	$_SESSION['login_error_msg'] = "";
	echo "good";
	header("Location: index.php");
} else {
	$status = "loggedOut";
	$_SESSION['login_error_msg'] = "Sorry, that user name or password is incorrect. Please try again.";
    header("Location: loginsys.php");
}

?>