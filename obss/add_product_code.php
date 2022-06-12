<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "obss";
$aid=$_GET['aid'];

$conn = mysqli_connect($servername, $username, $password, $dbname);

if(!$conn)
{

	die("Connection failed because ".mysqli_connect_error());
}


	if(isset($_POST['singlebutton']))
	{

		$bn = $_POST['product_name'];
		$genre = $_POST['genre']; 
		$qty = $_POST['available_quantity']; 
		$desc = $_POST['product_description'];     
		$price = $_POST['price'];
		$author = $_POST['author'];
		$bookfilename = $_FILES["bookimage"]["name"];
        $tempname = $_FILES["bookimage"]["tmp_name"];    
        $bookfolder = "C:/xampp/htdocs/obss/book_image/".$bookfilename;

			$query = "INSERT INTO products(book_name, book_price, book_qty, author_name, genre, book_image) VALUES('$bn','$price', '$qty', '$author', '$genre', '$bookfilename')";

			$data = mysqli_query($conn, $query);
			// Now let's move the uploaded image into the folder: image

			if($data && move_uploaded_file($tempname, $bookfolder))
			{
                echo '<script language="javascript">';
                echo 'alert("Successfully Updated"); location.href="http://localhost/obss/add_product.php?aid='.$aid.'"';
                echo '</script>';
			}
			else
			{
                echo '<script language="javascript">';
                echo 'alert("Not Updated"); location.href="http://localhost/obss/add_product.php?aid= '.$aid.' "';
                echo '</script>';
			}
			mysqli_close($conn);
	}
	

?>