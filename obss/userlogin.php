<?php
session_start();
?>
<?php
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>User Login</title>
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
         <label for="show" class="show-btn">CLICK TO LOGIN</label>
         <div class="container">
            <label for="show" class="close-btn fas fa-times" title="close"></label>
            <div class="text">
               USER LOGIN
            </div>
            <form action="login_check.php" method="POST">
               <div class="data">
                  <label>email</label>
                  <input type="text" name="email" required>
               </div>
               <div class="data">
                  <label>Password</label>
                  <input type="password" name="password" required>
               </div>
               <div class="forgot-pass">
                  <a href="forgotten-password.php">Forgot Password?</a>
               </div>
               <div class="btn">
                  <div class="inner"></div>
                  <button type="submit" name="userlogin">login</button>
               </div>
               <div class="signup-link">
                  Not a member? <a href="signup.php">Signup now</a>
               </div>
           
         </div>
      </div>
   </body>
</html>