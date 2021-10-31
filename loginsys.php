<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Saltaire Sports</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>

	<body onload="getScreenDetails()">
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


	<form name='form1' action="login.php" method="post">

	  <div class="logincontainer">
	  	<input type="hidden" id="width" name="width" value="0">
			<input type="hidden" id="height" name="height" value="0">
			<input type="hidden" id="durationspeed" name="durationspeed" value="duration">

			<h2><i>Login</i></h2>
	    <br><br>
	    <label for="userid"><b>Username</b></label>
	    <input type="text" placeholder="Enter Username" name="userid">
	    <br><br>
	    <label for="password"><b>Password</b></label>
	    <input type="password" placeholder="Enter Password" onclick="myclick()" name="password" id="password"><br><br>
	    <input type="checkbox" id="passcheck" onclick="showPassword()">Show Password</input><br><br>
	    <button type="submit" onclick="myclick()" id="loginbutton" formaction="login.php">Login</button>
	    <!--<button type="submit" class="cancelbtn1" formaction="logout.php">Log Out</button> -->
	  </div>


	<script>
	function showPassword() {
	  var x = document.getElementById("password");
	  if (x.type === "password") {
	    x.type = "text";
	  } else {
	    x.type = "password";
	  }
	}

	function getScreenDetails() {
		document.forms['form1']['width'].value = screen.width;
		document.forms['form1']['height'].value = screen.height;
	}



		
	function myclick() {
		var a = new Date();
		var endtime = a.getTime();
		var duration = ((endtime - starttime)/1000);
		duration = duration.toFixed(1);
		document.getElementById("durationspeed").value = duration;
		return duration
	}


	var a = new Date();
	var starttime = a.getTime();

	</script>


		<footer class="footerOnePage">
			<h2>&copy; 2021 Nathan Hannah <h2>
		</footer>

	</body>
</html>
    