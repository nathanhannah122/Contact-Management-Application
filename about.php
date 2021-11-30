<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>About Saltaire Sports</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<!-- Nav Bar -->
		<div id="header">
		<header>
			<h2>Saltaire Sports <i>Management System</i></h2>
			<div class="navigation">
				<a href="index.php">Home</a>
				<a class="current" href="about.php">About</a>
			</div>
		</div>

		<!-- Login Status -->
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

		<!-- Dropdown Menu -->
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
		</div>

		<!-- About Content -->
		<div class="aboutPage">
			<h2><i>About</i></h2>
			<h3>&nbsp; &nbsp;</strong><h3>
		</div>
		<div class="placeholder">
    	<p style="float: left;"><img src="img/Saltaire_sport.png" alt="SaltaireSportsLogo"height="200px" width="300px" border="1px"></p><br><br>
    	<p>Since we started business in 1871, we have been keeping paper records of our members' details.<br> Thanks to a grant from the National Lottery, we have been able to engage a local software development company in providing this piece of bespoke software.</p>
 		</div>
 		<p style="float: right; margin-top: 150px;"><img src="img/National-Lottery-Logo.png" alt="NationalLotteryLogo"height="200px" width="400px"></p>
 		<p id="location">We are located:<br> Victoria Hall <br> Saltaire <br>BD18 3JS <br> (44) 1274 327280</p>

 		<!-- Footer -->
		<footer class="footerOnePage">
			<h2>&copy; 2021 Nathan Hannah</h2>
		</footer>
	</body>
</html>

