<?php
session_start();
?>



<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>ONLINE BOOK SALE SYSTEM</title>
      <link rel="stylesheet" href="css\userlogin.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
   </head>
   <body>
      <div class="center">
      <?php
            if(isset($_SESSION['status']))
              {
               echo $_SESSION['status'];
               unset($_SESSION['status']);
              }
      ?>
         <input type="checkbox" id="show">
         <label for="show" class="show-btn">LOGIN</label>
         <div class="container">
            <label for="show" class="close-btn fas fa-times" title="close"></label>
            <div class="center">
            <div class="text">
               ADMIN LOGIN
            </div>
            <form action="login_check.php" method="POST">
               <div class="data">
                  <label>Email or Phone</label>
                  <input type="text" name="adminemail" required>
               </div>
               <div class="data">
                  <label>Password</label>
                  <input type="password" name = adminpassword required>
               </div>
               <div class="forgot-pass">
                  <a href="#">Forgot Password?</a>
               </div>
               <div class="btn">
                  <div class="inner"></div>
                  <button type="submit" name="adminsubmit">login</button>
               </div>
            </form>
         </div>
      </div>
   </body>
</html>