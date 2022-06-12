<?php

session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "obss";

$conn = mysqli_connect($servername, $username, $password, $dbname);
$aid = $_GET['aid'];

if(!$conn)
{

	die("Connection failed because ".mysqli_connect_error());
} // Using database connection file here

$id = $_GET['id']; // get id through query string

$del = mysqli_query($conn,"DELETE from products where bookid = '$id'"); // delete query

if($del)
{
    mysqli_close($conn); // Close connection
    echo '<script language="javascript">';
    echo 'alert("Successfully Deleted"); location.href="http://localhost/obss/list.php?aid='.$aid.'"';
    echo '</script>'; // redirects to all records page
    exit;	
}
else
{
    echo "Error deleting record"; // display error message if not delete
}
?>