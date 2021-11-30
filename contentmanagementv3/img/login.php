<?php
// Start the session
session_start();
?>

<!--- no time for when press log out, can use == 0 to not print to file --->

<!DOCTYPE html>
<HTML>
<head>
	<title>Login Saltaire Sports</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

<?php 
	$file = 'log.txt';

	$userid             = $_POST['userid'];
	$password           = $_POST['password'];
	$ip                 = $_SERVER["REMOTE_ADDR"];
	$port 			    = $_SERVER['REMOTE_PORT'];
	$screenheight       = $_POST['height'];
	$screenwidth        = $_POST['width'];
	$date               = date('d-m-Y H:i:s');
	$dateFormat         = "Accessed on : $date\r\n";
	$ipFormat           = "From IP: $ip\r\n";
	$portFormat         = "On Port: $port\r\n";
	$requestedurl       = $_SERVER['HTTP_REFERER'];
	$timeTaken          = $_POST['durationspeed'];
	$requestedUrlFormat = "Client Request : $requestedurl\r\n";
	$timeTakenFormat    = "Time Spent On Page : $timeTaken Seconds\r\n";
	$screenwidthFormat  = "User Screen Width : $screenwidth\r\n";
	$screenheightFormat  = "User Screen Height : $screenheight\r\n";

	$attempt  = False;
	$status   = False;
	$userid   = $_POST['userid'];
	$password = $_POST['password'];
	if (($userid == 'admin')  && ($password == 'saltaire')) {
		$status = "loggedInAdmin";
		$attempt = "SUCCESS";

	} else if (($userid == 'user')  && ($password == 'shipley')) {
		$attempt = "SUCCESS";
		$status = "loggedIn";
	} else if($timeTaken == 0) {
		$attempt = "OUT";
		$status = "loggedOut";
	} else{
		$status = "loggedOut";
		$attempt = "FAILED";
	}
	$_SESSION["status"] = $status;

	$attemptFormat  = "LOGIN : $attempt\r\n";
	if ($attempt != 'OUT') {
		$current = file_get_contents($file);
		$newLine=  "\r\n------------------------------$date-----------------------------------------\r\n" . $attemptFormat . "\r\n" . $timeTakenFormat . $screenwidthFormat . $screenheightFormat . "\r\n-CLIENT INFORMATION-\r\n" . "User: " . $userid . "\r\n" . $requestedUrlFormat . $ipFormat . $portFormat . $osFormat . "------------------------------------------------------------------------------------------\r\n";
		$current = $current . $newLine;
		file_put_contents($file, $current);
	}
?>

	<div id="header">
		<header>
			<h2>Saltaire Sports <i>Management System</i></h2>
			<!--<h2><a href="index.html">Saltaire Sports <i>Management System</a></h2>-->
			<div class="navigation">
				<a href="index.php">Home</a>
				<a href="about.php">About</a>
			</div>
		</div>
		<div class="dropdown">
  		<button class="dropbtn" id="loginstate">Status: <i><?php
		if ($_SESSION["status"] == 'loggedIn') {
		echo 'Logged in';
		} else if ($_SESSION["status"] == 'loggedInAdmin') {
		echo 'Logged in Admin';
		} else {
		echo 'Logged out';
		}
		?></i></button>
		  <div class="dropdown-content">
		  	<a href="login.php">My Account</a>
		  	<?php
			if ($_SESSION["status"] == 'loggedIn') {
			echo '<a href="logout.php">Sign out</a>';
			} else if ($_SESSION["status"] == 'loggedInAdmin') {
			echo '<a href="logout.php">Sign out</a>';
			} else {
			echo '<a href="loginsys.php">Sign in</a>';
			}
			?>
		  </div>
		</div>
	  </header>

	<<?php echo '<br><br><br><br><br><br>Current status is : ' . $status; ?>

	<form name='form1' id='form1' method="post" style="text-align: center; margin-top: 100px;">
			<?php
			if ($_SESSION["status"] == 'loggedIn') {
			echo 'Hello User';
			header("location:index.php");
			} else if ($_SESSION["status"] == 'loggedInAdmin') {
			echo '<a href="addUser.php">Add User</a>';
			echo '<br><a href="userlist.php">User list</a>';
			header("location:index.php");
			} else {
			echo 'alert("LOGIN FALIED")';
			header("location:loginsys.php");
			}
			?>
	</form>
</body>
</HTML>


