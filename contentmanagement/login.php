<?php
// Start the session
session_start();
?>

<!--- no time for when press log out, can use == 0 to not print to file --->

<!DOCTYPE html>
<HTML>
<head>
	<title>Login Saltaire Sports</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

<?php 
	$file = 'log.txt';

	$userid             = $_POST['userid'];
	$password           = $_POST['password'];
	$ip                 = $_SERVER["REMOTE_ADDR"];
	$port 			    = $_SERVER['REMOTE_PORT'];
	$screenheight       = $_POST['height'];
	$screenwidth        = $_POST['width'];
	$date               = date('d-m-Y H:i:s');
	$dateFormat         = "$date";
	$ipFormat           = " $ip";
	$portFormat         = " $port ";
	$requestedurl       = $_SERVER['HTTP_REFERER'];
	$timeTaken          = $_POST['durationspeed'];
	$requestedUrlFormat = "Client Request : $requestedurl\r\n";
	$timeTakenFormat    = " $timeTaken";
	$screenwidthFormat  = "$screenwidth) ";
	$screenheightFormat  = " ($screenheight x";

	$attempt  = False;
	$status   = False;
	$userid   = $_POST['userid'];
	$password = $_POST['password'];
	if (($userid == 'admin')  && ($password == 'saltaire')) {
		$status = "loggedInAdmin";
		$attempt = "SUCCESS";

	} else if (($userid == 'user')  && ($password == 'shipley')) {
		$attempt = "SUCCESS";
		$status = "loggedIn";
	} else if($timeTaken == 0) {
		$attempt = "OUT";
		$status = "loggedOut";
	} else{
		$status = "loggedOut";
		$attempt = "FAILED";
	}
	$_SESSION["status"] = $status;

	$attemptFormat  = "$attempt login attempt from ";
	if ($attempt != 'OUT') {
		$current = file_get_contents($file);
		$newLine= $date .  $ipFormat . $portFormat . $attemptFormat . $userid . $screenheightFormat . $screenwidthFormat . $timeTaken . "\r\n";
		$current = $current . $newLine;
		file_put_contents($file, $current);
	}
?>


<<?php 

function get_browser_name($user_agent){
    $t = strtolower($user_agent);
    $t = " " . $t;
    if     (strpos($t, 'opera'     ) || strpos($t, 'opr/')     ) return 'Opera'            ;   
    elseif (strpos($t, 'edge'      )                           ) return 'Edge'             ;   
    elseif (strpos($t, 'chrome'    )                           ) return 'Chrome'           ;   
    elseif (strpos($t, 'safari'    )                           ) return 'Safari'           ;   
    elseif (strpos($t, 'firefox'   )                           ) return 'Firefox'          ;   
    elseif (strpos($t, 'msie'      ) || strpos($t, 'trident/7')) return 'Internet Explorer';
    return 'Unknown';
}

$browser = get_browser_name($_SERVER['HTTP_USER_AGENT']);//Chrome

$file2 = 'marketing.csv';
if ($attempt != 'OUT') {
	$current = file_get_contents($file2);
	$newLine=  "\r\n" . $screenheight . "," . $screenwidth . "," . $timeTaken . "," . $browser;
	$current = $current . $newLine;
	file_put_contents($file2, $current);
}


 ?>

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

	<<?php echo '<br><br><br><br><br><br>Current status is : ' . $status; ?>

	<form name='form1' id='form1' method="post" style="text-align: center; margin-top: 100px;">
			<?php
			if ($_SESSION["status"] == 'loggedIn') {
			echo 'Hello User';
			header("location:index.php");
			} else if ($_SESSION["status"] == 'loggedInAdmin') {
			echo '<a href="addUser.php">Add User</a>';
			echo '<br><a href="userlist.php">User list</a>';
			header("location:index.php");
			} else {
			echo 'alert("LOGIN FALIED")';
			header("location:loginsys.php");
			}
			?>
	</form>
</body>
</HTML>


