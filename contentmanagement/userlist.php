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




<?php 
// if they are not logged in, exit.
if ($_SESSION["status"] == 'loggedInAdmin' or $_SESSION["status"] == 'loggedIn' ) {
	echo '<br><br><br><br><br><br><br><br>';
} else {
	exit('<br><br><br><br>You need to be logged in before you can view users.');
}
?>

<?php 
$userid   = $_POST['userid'];
$password = $_POST['password'];

if ($_SESSION["status"] == 'loggedOut')
{
	exit('<br><br><br>You need to log in admin before you can add more users');
} 

?>

<div class="userList">
<center>
<p style="float: left;"><img src="img/admin.png" alt="adminicon"height="200px" width="200px"></p>
<?php
$row = 1;
if (($handle = fopen("userdetails.csv", "r")) !== FALSE) {
   
    echo '<table border="1">';
   
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        if ($row == 1) {
            echo '<thead><tr>';
        }else{
            echo '<tr>';
        }
       
        for ($c=0; $c < $num; $c++) {
            //echo $data[$c] . "<br />\n";
            if(empty($data[$c])) {
               $value = "&nbsp;";
            }else{
               $value = $data[$c];
            }
            if ($row == 1) {
                echo '<th>'.$value.'</th>';
            }else{
                echo '<td>'.$value.'</td>';
            }
        }
       
        if ($row == 1) {
            echo '</tr></thead><tbody>';
        }else{
            echo '</tr>';
        }
        $row++;
    }
   
    echo '</tbody></table>';
    fclose($handle);
}
?>

</div>
</center>

<div>
	<form action="editusers.php" method="post" autocomplete="off" required>
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

<div id="errortext">
	<?php 
	$fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	if (strpos($fullurl, "index=empty") == true) {
		echo "<p style='color: red;'>Invalid index!</p>";
	}
	?>
</div>


<div class="list">
<?php
if ($_SESSION["status"] == 'loggedInAdmin') {
	echo '<a href="index.php">Home</a>';
	echo '<a href="addUser.php">Add User</a>';
} else {
	echo '<a href="index.php">Home</a>';
}
?>
</div>


<footer class="footerOnePage">
	<h2>&copy; 2021 Nathan Hannah <h2>
</footer>

</body>
</HTML>