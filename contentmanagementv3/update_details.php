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
      <!-- Nav Bar -->
      <div id="header">
         <header>
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


      <?php 
         // if they are not logged in, exit.
         if ($_SESSION["status"] == 'loggedInAdmin' ) {
         	echo '<br><br>';
         } else {
         	exit('<br><br><br><br>You need to be logged in as admin before you can add users.');
         }
         ?>
      <br><br><br>

      <!-- Submitted Details Form -->
      <h1> Details</h1>
      <p>The details you submitted are shown below:</p>
      <table>
         <tr>
            <td align="right">First name: </td>
            <td><?php echo $_POST["firstname"]; ?></td>
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
         $row = (is_numeric($_POST["customerindex"]));
         echo $row;

         $servername = "localhost";
         $username = "115696";
         $password = "saltaire";
         $dbname = "115696";

         $conn = mysqli_connect($servername, $username, $password, $dbname);

         if (!$conn) {
            die("Connection Failed: " . mysqli_connect_error());
         }

         $sql = "UPDATE contacts SET name='" . $fname . "',  email='" . $email . "',telephone='" . $phone . "',membership='" . $member ."' WHERE contactid='" . $row . "'";

         if (mysqli_query($conn, $sql)) {
           echo "Record updated successfully";
         } else {
           echo "Error updating record: " . mysqli_error($conn);
         }


         ?>
         <?php
         
         echo '<br>Home Run! Data Saved on Server';
         
         
         ?>
      <p><img src="img/animated.gif" alt="animatedbaseballplayer"height="200px" width="300px"></p>
      <br><br>
      <br>


      <!-- Buttons -->
      <div class="list">
         <a href="index.php">Home</a>
         <a href="userlist.php">User list</a>
         <a href="addUser.php">Add User</a>
      </div>

      <!-- Footer -->
      <footer class="footerOnePage">
         <h2>
         &copy; 2021 Nathan Hannah 
         <h2>
      </footer>
   </body>
</html>