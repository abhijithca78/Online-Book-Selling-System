<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Sign Up</title>
      <link rel="stylesheet" href="css\signup.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
   </head>
   <body>
      <div class="container">
         <header>Signup</header>
         <?php
                    if(isset($_SESSION['status']))
                    {
                      echo $_SESSION['status'];
                      unset($_SESSION['status']);
                    }
                ?>
         <div class="progress-bar">
            <div class="step">
               <p>
                  Name
               </p>
               <div class="bullet">
                  <span>1</span>
               </div>
               <div class="check fas fa-check"></div>
            </div>
            <div class="step">
               <p>
                  Contact
               </p>
               <div class="bullet">
                  <span>2</span>
               </div>
               <div class="check fas fa-check"></div>
            </div>
            <div class="step">
               <p>
                  Birth
               </p>
               <div class="bullet">
                  <span>3</span>
               </div>
               <div class="check fas fa-check"></div>
            </div>
            <div class="step">
               <p>
                  Submit
               </p>
               <div class="bullet">
                  <span>4</span>
               </div>
               <div class="check fas fa-check" ></div>
            </div>
         </div>
         <div class="form-outer">
            <form action="http://localhost/obss/php/insertsignup.php" method="POST" enctype="multipart/form-data">
               <div class="page slide-page">
                  <div class="title">
                     Basic Info:
                  </div>
                  <div class="field">
                     <div class="label">
                        First Name
                     </div>
                     <input type="text" id="firstname" name="firstname" required>
                  </div>
                  <div class="field">
                     <div class="label">
                        Last Name
                     </div>
                     <input type="text" id="lastname" name="lastname" required>
                  </div>
                  <div class="field">
                     <button class="firstNext next">Next</button>
                  </div>
               </div>
               <div class="page">
                  <div class="title">
                     Contact Info:
                  </div>
                  <div class="field">
                     <div class="label">
                        Email Address
                     </div>
                     <input pattern="^[A-Za-z0-9._]+@[A-Za-z]+\.[A-Za-z]{2,4}$" type="email"  id="email" name="email" required>
                  </div>
                  <div class="field">
                     <div class="label">
                        Phone Number
                     </div>
                     <input type="tel" pattern="[0-9]{10}" id="phone" name="phone" required>
                  </div>
                  <div class="field btns">
                     <button class="prev-1 prev">Previous</button>
                     <button class="next-1 next">Next</button>
                  </div>
               </div>
               <div class="page">
                  <div class="title">
                     Date of Birth:
                  </div>
                  <div class="field">
                     <div class="label">
                        Date
                     </div>
                     <input type="text"  id="date" name="date" required>
                  </div>
                  <div class="field">
                     <div class="label">
                        Gender
                     </div>
                     <input type="radio" name="sex" value="m">male
                     <input type="radio" name="sex" value="f">female
                     <input type="radio" name="sex" value="o">others
                  </div>
                  <div class="field btns">
                     <button class="prev-2 prev">Previous</button>
                     <button class="next-2 next">Next</button>
                  </div>
               </div>
               <div class="page">
                  <div class="title">

                     Login Details:
                  </div>
                  <div class="field">
                     <div class="label">
                        Image
                     </div>
                     <input type="file" name="uploadfile" id="image" required >
                  </div>
                  <div class="field">
                     <div class="label">
                        Username
                     </div>
                     <input type="text" id="username" name="username" required>
                  </div>
                  <div class="field">
                     <div class="label">
                        Password
                     </div>
                     <input type="password" id="password" name="password" required>
                  </div>
                  <div class="field btns">
                     <button class="prev-3 prev">Previous</button>
                     <button class="submit" name="submit" id="submit">Submit</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
      <script src="javascript\signup.js"></script>
   </body>
</html>