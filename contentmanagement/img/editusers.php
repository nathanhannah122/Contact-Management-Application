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
$index = $_POST["userindex"];


$csv = array();

 if(($handle = fopen("userdetails.csv", "r")) !== FALSE)
 {
    while(($data = fgetcsv($handle, 1000, ",")) !== FALSE)
    {
        $csv[] = $data;
    }
 }

 fclose($handle);

 $row = $index;

 $column = 0;
 echo $csv[$row][$column];
 $fname =  $csv[$row][$column];
 $column = 1;
 echo $csv[$row][$column];
 $lname =  $csv[$row][$column];
 $column = 2;
 echo $csv[$row][$column];
 $mail =  $csv[$row][$column];
 $column = 3;
 echo $csv[$row][$column];
 $tel =  $csv[$row][$column];
 $column = 4;
 echo $csv[$row][$column];
 $mem =  $csv[$row][$column];


 if ($fname == "") {
  echo "Index Incorrect GO back";
  echo '<br><br><br><a href="userlist.php">Back</a>';
}


?>

	<h1>Details</h1>
	<p>The details on file are as shown below.<br>
	Edit the data and save your changes to file.
	</p>
	<form action="save_details.php" method="post">
		<table>
			<tr>
				<td align="right">First name: </td><td>
				<?php echo "<input size=\"50\" type=\"text\" name=\"firstname\"value=\"$fname\">"?>
			</tr>
			<tr>
				<td align="right">Last name: </td>
				<td><?php echo "<input size=\"50\" type=\"text\" name=\"lastname\"value=\"$lname\">"?>
			</td>
			</tr>
			<tr>
				<td align="right">Email: </td><td>
				<?php echo "<input size=\"50\" type=\"text\" name=\"email\"value=\"$mail\">"?>
			</tr>
			<tr>
				<td align="right">Telephone: </td><td>
				<?php echo "<input size=\"50\" type=\"text\" name=\"telephone\"value=\"$tel\">"?>
			</tr>
			<tr>
				<td align="right">Membership: </td><td>
				<?php echo "<input size=\"50\" type=\"text\" name=\"membership\"value=\"$mem\">"?>
			</tr>
			<tr>
				<td> </td>
				<td colspan="2" align="left"><input type="submit" value="Save changes"></td>
			</tr>			
		</table>
	</form>














<?php 
// if they are not logged in, exit.
if ($_SESSION["status"] == 'loggedInAdmin') {
	echo '<br><br><br><br><br><You are logged in as Admin<br><br>';
} else {
	exit('br><br><br><br><br><br>You need to be logged in before you can add a user.');
}
?>

<?php 
$userid   = $_POST['userid'];
$password = $_POST['password'];

// make sure they are logged in
if (!isset($_SESSION["status"]))
{
	exit('<br><br><br>You need to log in before you can edit users');
} 

if ($_SESSION["status"] != 'loggedInAdmin')
{
	exit('<br>You need to log in admin before you can edit users');
} 


if ( $fname == '')
{
	exit('<br><br><br><br>You need to enter a valid index');
} 

// Add userid and password to list of authorised users, which is held in the session

?>

<form name='form1' id='form1' action="index.php" method="get">
	Home : <input type="submit"  value="Home">
</form>

</body>
</HTML>