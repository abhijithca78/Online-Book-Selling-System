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
		$filename = $_FILES["uploadfile"]["name"];
        $tempname = $_FILES["uploadfile"]["tmp_name"];    
        $folder = "C:/xampp/htdocs/obss/user_images/".$filename;
		$emailsearch= "SELECT * FROM signup WHERE email = '$em'";
		$emailsearchrun=mysqli_query($conn, $emailsearch);
		$row1=mysqli_fetch_array($emailsearchrun);
		$u_email=$row1['email'];

			$query = "UPDATE signup SET image = '$filename' WHERE email = '$u_email'";

			
			// Now let's move the uploaded image into the folder: image

			if($filename=="")
			{
				$_SESSION['status'] = "select an image ";
				header('location:http://localhost/obss/account.php');
				echo "yes";
			}
			else
			{
				$data = mysqli_query($conn, $query);
				if($data && move_uploaded_file($tempname, $folder))
				{
					$_SESSION['status'] = "successfully updated ";
					header('location:http://localhost/obss/account.php');
					echo "yes";
				}
				else
				{
					$_SESSION['status'] = "erorr updating image ";
					header('location:http://localhost/obss/account.php');
					echo"no";
				}
				mysqli_close($conn);
		    }
	    
	
	

?>