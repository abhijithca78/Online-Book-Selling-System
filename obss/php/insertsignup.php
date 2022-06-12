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


	if(isset($_POST['submit']))
	{

		$fn = $_POST['firstname'];
		$ln = $_POST['lastname'];
		$em = $_POST['email']; 
		$ph = $_POST['phone']; 
		$dt = $_POST['date'];     
		$gn = $_POST['sex'];
		$un = $_POST['username'];
		$ps = $_POST['password'];
		$filename = $_FILES["uploadfile"]["name"];
        $tempname = $_FILES["uploadfile"]["tmp_name"];    
        $folder = "C:/xampp/htdocs/obss/user_images/".$filename;
		$emailsearch= "SELECT * FROM signup WHERE email = '$em'";
		$emailsearchrun=mysqli_query($conn, $emailsearch);
		$row1=mysqli_fetch_array($emailsearchrun);
		$u_email=$row1['email'];

        if($em==$u_email)
		{
			$_SESSION['status'] = "email already exist ";

			header('location: http://localhost/obss/signup.php');
		}
		else
		{
			$query = "INSERT INTO signup(firstname, lastname, email, phone, date, gender, username, password, image) VALUES('$fn','$ln', '$em', '$ph', '$dt', '$gn', '$un', '$ps', '$filename')";

			$data = mysqli_query($conn, $query);
			// Now let's move the uploaded image into the folder: image

			if($data && move_uploaded_file($tempname, $folder))
			{
			$_SESSION['status'] = "successfully registerd ";
			header('location:http://localhost/obss/userlogin.php');
			}
			else
			{
			echo "Data insert failed";
			}
			mysqli_close($conn);
	    }
	}
	

?>