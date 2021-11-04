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
         	echo '<br><br><br><br><br><br><br><br>';
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
         $image = $_POST["image"];
         
         
         echo '<br>Home Run! Data Saved on Server';
         
         // Takes index to edit specific user
         $index = $_POST["customerindex"]; ;
         $i = 0;
         $newdata = [];
         $handle = fopen("userdetails.csv", "r");
         
         // READ CSV
         while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {      
         
             if ($i == $index) {
                 $newdata[$i][] = $fname;          
                 $newdata[$i][] = $lname;   
                 $newdata[$i][] = $email;  
                 $newdata[$i][] = $phone;
                 $newdata[$i][] = $member;
                 $newdata[$i][] = $image;
                 $i++;
                 continue;
             }  
             $newdata[$i][] = $data[0];          
             $newdata[$i][] = $data[1];    
             $newdata[$i][] = $data[2];      
             $newdata[$i][] = $data[3];    
             $newdata[$i][] = $data[4];   
             $newdata[$i][] = $data[5];  
             $i++;    
         }
         
         // EXPORT CSV
         $fp = fopen('userdetails.csv', 'w');    
         foreach ($newdata as $rows) {
             fputcsv($fp, $rows);
         }    
         fclose($fp);
         
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