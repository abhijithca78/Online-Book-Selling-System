<?php
session_start();
include('dbconn.php');
include('password-change.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


//load composers autoloader
require "vendor/autoload.php";
function send_password_reset($get_name,$get_email,$token)
{
    $mail = new PHPMailer(true);
        //Server settings                     
       
    try {   
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'onlinebooksellingsystem@gmail.com';                     //SMTP username
        $mail->Password   = 'Obss@560086';                               //SMTP password
        $mail->SMTPSecure = "tls";            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('onlinebooksellingsystem@gmail.com',$_getname);
        $mail->addAddress($get_email);     //Add a recipient
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'reset password';
        $email_template = "<h2>hello</h2>
        <h3>we have send you a link</h3> 
        <br/><br/>
        <a href= 'http://localhost/obss/password-change.php?token=$token&email=$get_email'>click me</a>"; 
       
        $mail->Body    = $email_template;
        $mail->send();
    } 
    catch (Exception $e) 
    {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        $_SESSION['status'] = "sorry something went wrong";
        header("location: forgotten-password.php");
        exit(0);
    }
}
if(isset($_POST['password_reset_link']))
{
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $token = md5(rand());

    $check_email = "SELECT email FROM signup Where email ='$email' LIMIT 1";
    $check_email_run = mysqli_query($conn, $check_email);

    if(mysqli_num_rows($check_email_run)>0)
    {
        $row = mysqli_fetch_array($check_email_run);
        $get_name = $row['firstname'];
        $get_email = $row['email'];
        
        $update_token = "UPDATE signup SET verify_token='$token' WHERE email ='$get_email' LIMIT 1";
        $update_token_run = mysqli_query($conn, $update_token);

        if($update_token_run)
        {
        send_password_reset($get_name,$get_email,$token);
        $_SESSION['status'] = "we have send you a mail";
        header("location: forgotten-password.php");
        exit(0);
        }
        else
        {
        
        $_SESSION['status'] = "something went wrong. #1";
        header("location: forgotten-password.php");
        exit(0);
        }

    }
    else
    {
        
        $_SESSION['status'] = "no email found";
        header("location: forgotten-password.php");
        exit(0);
    }
}



if(isset($_POST['password_update']))
{
    $email=$_POST['email'];
    $new_password= $_POST['np'];
    $confirm_password=$_POST['cp'];

    $token=$_POST['password_token'];

    if(!empty($token))
    {
        if( !empty($email) && !empty($new_password) && !empty($confirm_password))
        {
            //checking token validity
            $check_token = "SELECT verify_token FROM signup WHERE verify_token='$token' LIMIT 1";
            $check_token_run = mysqli_query($conn, $check_token);

            if(mysqli_num_rows($check_token_run)>0)
            {
                if($new_password==$confirm_password)
                {
                    $update_password = "UPDATE signup SET PASSWORD ='$new_password' WHERE verify_token ='$token' LIMIT 1";
                    $update_password_run = mysqli_query($conn,$update_password);
                    
                    if($update_password_run)
                    {
                        $_SESSION['status'] = "New password succesfully updated";
                        header("location: userlogin.php");
                        exit(0);
                    }
                    else
                    {
                        $_SESSION['status'] = "did not update password something went wrong";
                        header("location: password-change.php?token=$token&email=$email");
                        exit(0);  
                    }
                }
                else
                {
                    $_SESSION['status'] = "new password and confirm password does not match";
                    header("location: password-change.php?token=$token&email=$email");
                    exit(0); 
                }
            }
            else
            {
            $_SESSION['status'] = "invalid token";
            header("location: password-change.php?token=$token&email=$email");
            exit(0);
            }

        }
        else
        {
            $_SESSION['status'] = "All fields are mandatory";
            header("location: password-change.php?token=$token&email=$email");
            exit(0);
        }
    }
    else
    {
        $_SESSION['status'] = "no token found";
        header("location: password-change.php");
        exit(0);
    }
}
else
{
    $_SESSION['status'] = "invalid choice";
    header("location: password-change.php");
    exit(0);
}



?>