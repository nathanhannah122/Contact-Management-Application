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




<?php 
// if they are not logged in, exit.
if ($_SESSION["status"] == 'loggedInAdmin') {
	echo '<br><br><br><br><br><br>You are logged in as Admin<br><br>';
} else {
	exit('You need to be logged in before you can add a user.');
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
	exit('<br><br><br>You need to log in admin before you can add more users');
} 

?>

<div class="userList">
<center>
<?php
        echo "<html><body><center><table>\n\n";
  
        // Open a file
        $file = fopen("userdetails.csv", "r");
  
        // Fetching data from csv file row by row
        while (($data = fgetcsv($file)) !== false) {
  
            // HTML tag for placing in row format
            echo "<tr>";
            foreach ($data as $i) {
                echo "<td>" . htmlspecialchars($i) 
                    . "</td>";
            }
            echo "</tr> \n";
        }
  
        // Closing the file
        fclose($file);
  
        echo "\n</table></center></body></html>";
        ?>

</div>
</center>

<div>
	<form action="editusers.php" method="post" autocomplete="off">>
		<table class="logincontainer">
		<tr>
			<td align="right">Please enter a user index to edit or a new index to add a user:  </td>
			<td><input maxlength="2" type="text" maxlength="2" name="userindex"></td>
		</tr>
		<tr>
			<td> </td>
			<td colspan="2"><input type="submit" value="Submit" ></td>
		</tr>
		</table>
	</form>
</div>



<form name='form1' id='form1' action="index.php" method="get">
	Home : <input type="submit"  value="Home">
</form>

<footer class="footerOnePage">
	<h2>&copy; 2021 Nathan Hannah <h2>
</footer>

</body>
</HTML>