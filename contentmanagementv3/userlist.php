<?php
// Start the session
session_start();
?>

<?php include 'DBConn.php'; ?>

<!DOCTYPE html>
<HTML>
<head>
	<title>Saltaire Sports</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
	echo '<br><br>';
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

<!--
<div class="userList">
<center>
<p style="float: left;"><img src="img/admin.png" alt="adminicon"height="200px" width="200px"></p>
<?php
/*
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
*/
?>
-->

<div class="userList">
     <form class="table table-striped table-bordered table-sm" name='formList' id='formList' action="editusers.php" method="post">
      <table class="table">
        <thead>
          <tr>
            <th scope="col" >#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Telephone</th>
            <th scope="col">Membership</th>
            <th scope="col">Command</th>
          </tr>
        </thead>
        <tbody> 
</div>

<!-- ADDED CODE-->

<?php
  $conn = getDBConnection();    // get connection to database
  getContactData($conn);        // get contact detail and format into table row

//
// This function builds a table row containing contact details for one contact
// input : the DB row id, name and email address of a contact
// output : a html table row with table data for each of the three columns.
//
function buildTableEntry($id, $name, $email, $tel, $mem) {
  echo '<tr>';
  echo '<th scope="row">' . $id . '</th>';
  echo '<td>' . $name . '</td>';
  echo '<td>' . $email . '</td>';
  echo '<td>' . $tel . '</td>';
  echo '<td>' . $mem . '</td>';
  echo '<td>';
  echo '  <button type="submit" class="btn btn-primary" name="edit" value="'.$id.'">Edit</button>';
  echo '  <button type="submit" class="btn btn-danger" name="deletebtn" value="'.$id.'"formaction="/shipley/115696/php/contactmanagementv3/delete.php">Delete</button>';
  //echo '  <button type="submit" class="btn btn-danger" id"deletebtn">Delete</button>';
  echo '</td>';
  echo '</tr>';
  echo "\r\n";
}

//
// This function reads contact data from the database and calls buildTableEntry
//
function getContactData($conn) {
  $sql = "SELECT contactid, name, email, telephone, membership FROM contacts";
  $result = mysqli_query($conn, $sql);      // access database
  if (mysqli_num_rows($result) > 0) {       // if more than 0 rows returned
    while($row = mysqli_fetch_assoc($result)) {  // build table row for each returned row
      buildTableEntry($row["contactid"], $row["name"], $row["email"], $row["telephone"], $row["membership"]);
    }
  } else {
    echo "0 results";
  }
}


?>

<script>
function confirmDelete(e, rowID) {
  e.preventDefault();
  var r = confirm("Do you really want to delete row " + rowID + "?");
  if (r == true) {
  	window.location="delete.php";
    alert("Row deleted");
  } else {
    alert("Row not deleted");
  }
  return false;
}


$(document).ready(function () {
  $('#dtBasicExample').DataTable();
  $('.dataTables_length').addClass('bs-select');
});
</script>

<script>
	document.getElementById("deletebtn").addEventListener("click", deleteDirect);
	function deleteDirect() {
		window.location.href="https://hosting.shipley.ac.uk/shipley/115696/php/contactmanagementv3/delete.php";
	}
</script>



</div>
</center>
<!--
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
-->

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
