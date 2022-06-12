<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "obss";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if(!$conn)
{

	die("Connection failed because ".mysqli_connect_error());
}
        if(isset($_SESSION['uname']))
        {
            $em=$_SESSION['uemail'];
        }

        $updatefname=$_POST['fname'];
        $updatelname = $_POST['lname'];
        $updateuname = $_POST['username'];
        $newpassword = $_POST['newpswd'];
        $confirmnewpassword = $_POST['confnewpswd'];
		$emailsearch= "SELECT * FROM signup WHERE email = '$em'";
		$emailsearchrun=mysqli_query($conn, $emailsearch);
		$row1=mysqli_fetch_array($emailsearchrun);
		$u_email=$row1['email'];

			$query = "UPDATE signup SET password = '$newpassword' WHERE email = '$u_email'";

			$data = mysqli_query($conn, $query);
			// Now let's move the uploaded image into the folder: image

            if($newpassword==$confirmnewpassword)
            {
                if($newpassword=="" && $confirmnewpassword=="")
                {
                    $_SESSION['status'] = "erorr updating password";
                    header('location:http://localhost/obss/account.php');
                    echo "password match";
                }
                else
                {
                    $data = mysqli_query($conn, $query);
                    if($data)
                    {
                    $_SESSION['status'] = "successfully updated password ";
                    header('location:http://localhost/obss/account.php');
                    }
                }
                
            }
            else
            {
                $_SESSION['status'] = "password does not match ";
                header('location:http://localhost/obss/account.php');
            }
	    
	
	

?>