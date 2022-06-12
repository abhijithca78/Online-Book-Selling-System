<?php 
session_start();

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Change Password</title>
    <?php
         if(isset($_SESSION['status']))
            {      
                echo $_SESSION['status'];
                unset($_SESSION['status']);
            }
                ?>
	<link rel="stylesheet"  href="css\password-change.css">
</head>
<body>
    <form action="password-reset-code.php" method="POST">
     	<h2>Change Password</h2>
        <input type="hidden" name ="password_token" value="<?php if(isset($_GET['token'])){echo $_GET['token'];}?>">

     	<label>email</label>
     	<input type="text" 
     	       name="email" 
			   placeholder="email"
               value ="<?php if(isset($_GET['email'])){echo $_GET['email'];} ?>" 
     	       >
            <br>
     	       

     	<label>New Password</label>
     	<input type="text"  
               name="np" 
     	       placeholder="New Password">
     	       <br>

     	<label>Confirm New Password</label>
     	<input type="text" 
               name="cp" 
     	       placeholder="Confirm New Password">
     	       <br>

     	<button type="submit" name="password_update">CHANGE</button>
          <a href="home.php" class="ca">HOME</a>
     </form>
</body>
</html>
