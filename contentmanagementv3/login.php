<?php
   // Start the session
   session_start();

// Get parameters from login page
$userid    = $_POST['userid'];
$password = $_POST['password'];


// Try and login
$status = loginDB($userid, $password);
if ($status == "loggedInAdmin") {
   processGoodLogin($status);    // process good login
} else {
   processBadLogin($status);     // process bad login
}

//
// Test function to see if login works

function loginMock($userid, $password) {
   $DEFAULT_USERID   = 'nathan';
   $DEFAULT_PASSWORD = '123';

   if (($userid == $DEFAULT_USERID)  && ($password == $DEFAULT_PASSWORD)) {
      $status = "loggedInAdmin";
   } else {
      $status = "loggedOut";
   }
   return $status;
}


//
// Test function to see if login works
//
function loginDB($userid, $password) {
   $servername = "localhost";
   $username = "115696";
   $password = "saltaire";
   $dbname = "115696";

   // Create connection
   $conn = new mysqli($servername, $username, $password, $dbname);
   // Check connection
   if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
   }

}


//
// Get database connection
//
function getDBConnection() {
   // get connection to MySQL database
   $servername = "localhost";
   $username = "115696";
   $password = "saltaire";
   $dbname = "115696";

   // Create connection
   $conn = mysqli_connect($servername, $username, $password, $dbname);
   // Check connection
   if (!$conn) {
     die("Connection failed: " . mysqli_connect_error());
   }
   return $conn;
}




//
// check if credentials passed are in db
//
function checkCreds($userid, $password) {
   $servername = "localhost";
   $username = "115696";
   $password = "saltaire";
   $dbname = "115696";

   // Create connection
   $conn = new mysqli($servername, $username, $password, $dbname);
   // Check connection
   if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
   }

   $sql = "SELECT userid FROM users WHERE userid='" . $userid . "'AND password='" . $password . "'";
   $result = $conn->query($sql);

   if ($result->num_rows == 1) {
      $status = "loggedInAdmin";

   } else {
       echo "0 results";
       $status = "loggedOut";
   }
   return $status;
   $conn->close(); 
}




//
// Process good login
//
function processGoodLogin($status) {
   $_SESSION["status"] = $status;
   $_SESSION['login_error_msg'] = "";
   echo "good";
   header("Location: index.php");
   exit();  
}

//
// Process bad login
//
function processBadLogin($status) {
   $_SESSION["status"] = $status;
   $_SESSION['login_error_msg'] = "Sorry, that user name or password is incorrect. Please try again.";
   header("Location: loginsys.php");
   exit();     
}


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
         $timeTakenFormat    = " $timeTaken";
         $screenwidthFormat  = "$screenwidth) ";
         $screenheightFormat  = " ($screenheight x";
         
         $attempt  = False;
         $status   = False;
         $userid   = $_POST['userid'];
         $password = $_POST['password'];

         
         
         $attemptFormat  = "$attempt login attempt from ";
         if ($attempt != 'OUT') {
         	$current = file_get_contents($file);
         	$newLine= $date .  $ipFormat . $portFormat . $attemptFormat . $userid . $screenheightFormat . $screenwidthFormat . $timeTaken . "\r\n";
         	$current = $current . $newLine;
         	file_put_contents($file, $current);
         }
         ?>
      <?php 
         // gets browser name
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
            <!-- Nav bar -->
            <h2>Saltaire Sports <i>Management System</i></h2>
            <div class="navigation">
               <a href="index.php">Home</a>
               <a href="about.php">About</a>
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
      </form>
   </body>
</HTML>