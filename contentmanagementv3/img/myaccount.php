<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Saltaire Sports</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>

	<body>
		<div id="header">
		<header>
			<h2><a href="index.php">Saltaire Sports <i>Management System</i></a></h2>
			<div class="navigation">
				<a href="index.php">Home</a>
				<a href="about.php">About</a>
			</div>
		</div>
		<div class="dropdown">
  		<button class="dropbtn">Status: <i><?php
		if ($_SESSION["status"] == 'loggedIn') {
		echo 'Logged in';
		} else if ($_SESSION["status"] == 'loggedInAdmin') {
		echo 'Logged in Admin';
		} else {
		echo 'Logged out';
		}
		?></i></button>
		  <div class="dropdown-content">
		  	<a href="myaccount.php">My Account</a>
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

	<?php
	// if they are not logged in, exit.
	if ($_SESSION["status"] == 'loggedInAdmin') {
		echo '<br><br><br><br><br><br>You are logged in as Admin Username = admin <br> password=<br><br> You can add users, edit users and view all users, you can access the log';
	} else if ($_SESSION["status"] == 'loggedIn') {
		echo '<br><br><br><br><br><br>You are logged in as a user Username = user <br> password=<br><br> You can add view all users';
	} else {
		exit('<br><br><br><br><br><br>You need to be logged in to see account details');
	}
	?>






		<footer class="footerOnePage">
			<h2>&copy; 2021 Nathan Hannah <h2>
		</footer>

	</body>
</html>