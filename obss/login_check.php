<?php
session_start();
?>
<?php
include 'dbconn.php';


?>

<?php

$conn = mysqli_connect($servername, $username, $password, $dbname);

//user login verification

if(isset($_POST['userlogin']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    $emailpasswordsearch= "SELECT * FROM signup WHERE email = '$email' AND password = '$password'";
    $emailsearch= "SELECT * FROM signup WHERE email = '$email'";
    $username = "SELECT * FROM signup WHERE email = '$email'";
    $imagesearch = "SELECT * FROM signup WHERE email = '$email'";
    $lnamesearch = "SELECT * FROM signup WHERE email = '$email'";
    $uidsearch="SELECT * FROM signup WHERE email = '$email'";

    $imagesearchrun = mysqli_query($conn, $imagesearch);
    $emailsearchrun=mysqli_query($conn, $emailsearch);
    $emailpasswordsearchrun=mysqli_query($conn, $emailpasswordsearch);
    $usernamerun=mysqli_query($conn, $username);
    $lnamerun=mysqli_query($conn, $lnamesearch);
    $uidrun=mysqli_query($conn, $uidsearch);

    $row1=mysqli_fetch_array($emailsearchrun);
    $row2=mysqli_fetch_array($emailpasswordsearchrun);
    $userrow3=mysqli_fetch_assoc($usernamerun);
    $row4=mysqli_fetch_assoc($imagesearchrun);
    $row5=mysqli_fetch_array($lnamerun);
    $row6=mysqli_fetch_array($uidrun);


    $u_name=$userrow3['firstname'];
    $u_email=$row1['email'];
    $image =$row4['image'];
    $lname =$row5['lastname'];
    $username =$row5['username'];
    $uid =$row6['id'];


    if($row1['email'] == $email)
    {
        
        if($row2['email'] == $email && $row2['password'] == $password)
        {
            
            $_SESSION['status'] = "welcome ";
            $_SESSION['uname'] = $u_name;
            $_SESSION['uemail'] = $u_email;
            $_SESSION['image'] = $image;
            $_SESSION['lastname']=$lname;
            $_SESSION['username']=$username;
            $_SESSION['id']=$uid;

            header("location: product.php?uid=$uid");
            
        }
    else
    {
        $_SESSION['status'] = "wrong password";
        header("location: userlogin.php");
        exit(0);
    }
}
else
{
    $_SESSION['status'] = "no mail found";
    header("location: userlogin.php");
    exit(0);
}
}



//admin login verification


if(isset($_POST['adminsubmit']))
{
    $adminemail = $_POST['adminemail'];
    $adminpassword = $_POST['adminpassword'];

    $emailpasswordsearchadmin= "SELECT * FROM admin WHERE email = '$adminemail' AND password = '$adminpassword'";
    $emailsearchadmin= "SELECT * FROM admin WHERE email = '$adminemail'";
    $adminname = "SELECT * FROM admin WHERE email = '$adminemail'";

    $emailsearchrunadmin=mysqli_query($conn, $emailsearchadmin);
    $emailpasswordsearchrunadmin=mysqli_query($conn, $emailpasswordsearchadmin);
    $adminnamerun=mysqli_query($conn, $adminname);
    $adminrow1=mysqli_fetch_array($emailsearchrunadmin);
    $adminrow2=mysqli_fetch_array($emailpasswordsearchrunadmin);
    $adminrow3=mysqli_fetch_assoc($adminnamerun);
    $name=$adminrow3['firstname'];
    $aid=$adminrow3['id'];



    if($adminrow1['email'] == $adminemail)
    {
        
        if($adminrow2['email'] == $adminemail && $adminrow2['password'] == $adminpassword)
        {
            $_SESSION['name'] = $name;

            header("location:admin-panel.php?aid=$aid");
            exit(0);

        }
        else
        {
            $_SESSION['status'] = "wrong password";
            header("location: adminlogin.php");
            exit(0);
        }
    }
    else
    {
        $_SESSION['status'] = "no mail found";
        header("location: adminlogin.php");
        exit(0);
    }
}


?>