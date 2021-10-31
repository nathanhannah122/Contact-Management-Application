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


	<div class="container">
	<form action="save_details.php" method="post">
		<p>Please enter details:</p>
			<table class="logincontainer">
				<tr>
					<td align="right">First name:  </td>
					<td><input size="20" type="text" maxlength="15" name="firstname"></td>
				</tr>	
				<tr>
					<td align="right">Last name:  </td>
					<td><input size="40" type="text" maxlength="15" name="lastname"></td>
				</tr>
				<tr>
					<td align="right">Email:  </td>
					<td><input size="20" type="text" name="email"></td>
				</tr>
				<tr>
					<td align="right">Membership:</td>
					<td><select name="membership" id="membershipSelect">
					    <option value="Casual">Casual</option>
					    <option value="Fitness">Fitness</option>
					    <option value="Dedicated">Dedicated</option>
					  	</select></td>
				</tr>
				<tr>
					<td align="right">Telephone:  </td>
					<td><input size="20" type="text" name="telephone"></td>
				</tr>
				<tr>
					<td align="right">Image URL:  </td>
					<td><input size="20" type="text" name="image"></td>
				</tr>
				<tr>
					<td> </td>
					<td colspan="2"><input type="submit" value="Submit" ></td>
				</tr>
			</table>
		</form>
		</div>

<?php 
// if they are not logged in, exit.
if ($_SESSION["status"] == 'loggedInAdmin') {
	echo '<br><br><br><br><br><You are logged in as Admin<br><br>';
} else {
	exit('<br><br><br><br><br><br>You need to be logged in before you can add a user.');
}
?>

<?php 
$userid   = $_POST['userid'];
$password = $_POST['password'];

// make sure they are logged in
if (!isset($_SESSION["status"]))
{
	exit('<br><br><br>You need to log in before you can add more users');
} 

if ($_SESSION["status"] != 'loggedInAdmin')
{
	exit('<br>You need to log in admin before you can add more users');
} 

// Add userid and password to list of authorised users, which is held in the session

?>

<div class="list">
<a href="index.php">Home</a>
<a href="userlist.php">Userlist</a>
<a href="addUser.php">Add User</a>
</div>
<footer class="footerOnePage">
	<h2>&copy; 2021 Nathan Hannah <h2>
</footer>

</body>
</HTML>