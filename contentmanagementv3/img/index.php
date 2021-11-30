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
	  		<h2><strong>Welcome!</strong></h2>
	  		<h2>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla quam velit, vulputate eu pharetra nec, mattis ac neque. Duis vulputate commodo lectus, ac blandit elit tincidunt id. Sed rhoncus, tortor sed eleifend tristique, tortor mauris molestie elit, et lacinia ipsum quam nec dui. Quisque nec mauris sit amet elit iaculis pretium sit amet quis magna. Aenean velit odio, elementum in tempus ut, vehicula eu diam. Pellentesque rhoncus aliquam mattis. Ut vulputate eros sed felis sodales nec vulputate justo hendrerit. Vivamus varius pretium ligula, a aliquam odio euismod sit amet. Quisque laoreet sem sit amet orci ullamcorper at ultricies metus viverra. Pellentesque arcu mauris, malesuada quis ornare accumsan, blandit sed diam.</h2>
			</div>

 		<div class="list">
	 		<h3></h3><br>
			<?php
			if ($_SESSION["status"] == 'loggedIn') {
			echo 'Hello User';
			} else if ($_SESSION["status"] == 'loggedInAdmin') {
			echo 'Hello Admin';
			echo '<br><a href="addUser.php">AddUser</a>';
			echo '<br><br><br><a href="userlist.php">User List</a>';
			} else {
			echo '<br><a href="loginsys.php">Login Screen</a>';
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
    