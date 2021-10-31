<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Saltaire Sports</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="shortcut icon" type="img/png" href="favicon.png"/>
	</head>

	<body>
		<div id="header">
		<header>
			<h2>Saltaire Sports <i>Management System</i></h2>
			<!--<h2><a href="index.html">Saltaire Sports <i>Management System</a></h2>-->
			<div class="navigation">
				<a class="current" href="index.php">Home</a>
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

		<div id="welcomeText">
	  		<h2><strong><?php
			if ($_SESSION["status"] == 'loggedIn') {
			echo 'Hello User!';
			} else if ($_SESSION["status"] == 'loggedInAdmin') {
			echo 'Hello Admin!';
			} else{
				echo'Welcome!';
			} ?>
		</strong></h2>
	  		<p>This is the Saltaire Sports Management System.</p>
			</div>

 		<div class="list">
	 		<h3></h3><br>
			<?php
			if ($_SESSION["status"] == 'loggedIn') {
			echo '<br><br><a href="userlist.php">User List</a>';
			} else if ($_SESSION["status"] == 'loggedInAdmin') {
			echo '<br><a href="addUser.php">Add User</a>';
			echo '<a href="userlist.php">User List</a>';
			echo '<a href="log.txt">View Log</a>';
			echo '<a href="https://hosting.shipley.ac.uk/shipley/115696/php/contactmanagement/marketing.csv">Download Marketing log</a>';
			} else {
			echo '<a href="loginsys.php">Login Screen</a>';
			}
			?>
		    <!--<button type="submit" class="signupbtn" href="/loginsys.html">Login Screen</button>
		    <button type="sumbit" class="cancelbtn1" formaction="logout.php">Log Out</button>-->
 		</div>
		<footer class="footerOnePage">
			<h2>&copy; 2021 Nathan Hannah <h2>
		</footer>

	</body>
</html>
    