<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<HTML>
<head>
	<title>Saltaire Sports</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
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



	<br><br><br>
	<h1> Details</h1>
	<p>The details you submitted are shown below:</p>
	<table>
		<tr>
			<td align="right">First name: </td>
			<td><?php echo $_POST["firstname"]; ?></td>
		</tr>
		<tr>
			<td align="right">Last name: </td>
			<td><?php echo $_POST["lastname"]; ?></td>
		</tr>
		<tr>
			<td align="right">Email: </td>
			<td><?php echo $_POST["email"]; ?></td>
		</tr>
		<tr>
			<td align="right">Telephone: </td>
			<td><?php echo $_POST["telephone"]; ?></td>
		</tr>
		<tr>
			<td align="right">Membership Status: </td>
			<td><?php echo $_POST["membership"]; ?></td>
		</tr>
	</table>

<?php


$fname = $_POST["firstname"];
$lname = $_POST['lastname'];
$email = $_POST["email"];
$member = $_POST["membership"];
$phone = $_POST["telephone"];


$file = 'userdetails.csv';


$current = file_get_contents($file);
$newLine=  "\r\n" . $fname . "," . $lname . "," . $email . "," . $phone . "," . $member;
$current = $current . $newLine;
file_put_contents($file, $current);

echo '<br>Home Run! Data Saved on Server';


?>

<p><img src="img/animated.gif" alt="animatedbaseballplayer"height="200px" width="300px"></p><br><br>
<br>
<div class="list">
<a href="index.php">Home</a>
<a href="userlist.php">Userlist</a>
<a href="addUser.php">Add User</a>
</div>
<footer class="footerOnePage">
	<h2>&copy; 2021 Nathan Hannah <h2>
</footer>

</body>	

</html>