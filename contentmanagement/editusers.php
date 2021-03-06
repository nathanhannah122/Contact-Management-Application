<?php
   // Start the session
   session_start();
   
   $index = $_POST['userindex'];
   // checks if user entry is empty
   // if empty redirects to previous page
   if (empty($index)) {
   	header("location:userlist.php?index=empty");
   	exit();
   }
   
   
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
         // gives different options based on user status
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

      <!-- Data from CSV to Populate table -->
      <?php
         $index = $_POST["userindex"];
         // validates entry and redirects them back to previous page
         if ($index == 0 or '') {
           header("location:userlist.php");
         }
         
         //opens CSV to get values
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
          $fname =  $csv[$row][$column];
          $column = 1;
          $lname =  $csv[$row][$column];
          $column = 2;
          $mail =  $csv[$row][$column];
          $column = 3;
          $tel =  $csv[$row][$column];
          $column = 4;
          $mem =  $csv[$row][$column];
          $column = 5;
          $img =  $csv[$row][$column];
         
         
          if ($fname == "") {
           echo "Index Incorrect GO back";
           echo '<br><br><br><a href="userlist.php">Back</a>';
         }
         
         ?>
      <?php 
         // if they are not logged in, exit.
         if ($_SESSION["status"] == 'loggedInAdmin') {
         	echo '<br><br><br><br><br><You are logged in as Admin<br><br>';
         } else {
         	exit('<br><br><br><br><br><br>You need to be logged in as Admin before you can add a user.');
         }
         ?>

      <!-- Edit Details Form -->
      <h1>Details</h1>
      <p>The details on file are as shown below.<br>
         Edit the data and save your changes to file.
      </p>
      <form action="update_details.php" method="post">
         <table>
            <?php echo" <input type=\"hidden\" id=\"width\" name=\"customerindex\" value=\"$index\" >"?>
            <tr>
               <td align="right">First name: </td>
               <td>
                  <?php echo "<input size=\"50\" type=\"text\" name=\"firstname\"value=\"$fname\">"?>
            </tr>
            <tr>
               <td align="right">Last name: </td>
               <td><?php echo "<input size=\"50\" type=\"text\" name=\"lastname\"value=\"$lname\">"?>
               </td>
            </tr>
            <tr>
               <td align="right">Email: </td>
               <td>
                  <?php echo "<input size=\"50\" type=\"text\" name=\"email\"value=\"$mail\">"?>
            </tr>
            <tr>
               <td align="right">Telephone: </td>
               <td>
                  <?php echo "<input size=\"50\" type=\"text\" name=\"telephone\"value=\"$tel\">"?>
            </tr>
            <tr>
               <td align="right">Membership: </td>
               <td>
                  <?php echo "<input size=\"50\" type=\"text\" name=\"membership\"value=\"$mem\">"?>
            </tr>
            <tr>
               <td align="right">Image: </td>
               <td>
                  <?php echo "<input size=\"50\" type=\"text\" name=\"img\"value=\"$img\">"?>
            </tr>
            <tr>
               <td> </td>
               <td colspan="2" align="left"><input type="submit" value="Save changes"></td>
            </tr>
         </table>
      </form>


      <!-- Login authentication -->
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
         
         
         ?>

      <!-- Buttons -->
      <div class="list">
         <a href="index.php">Home</a>
         <a href="userlist.php">Userlist</a>
         <a href="addUser.php">Add User</a>
      </div>


      <!-- Footer -->
      <footer class="footerOnePage">
         <h2>
         &copy; 2021 Nathan Hannah 
         <h2>
      </footer>
   </body>
</HTML>