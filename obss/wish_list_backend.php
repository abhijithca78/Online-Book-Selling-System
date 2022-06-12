<?php
include "dbconn.php";
$id=$_GET['bookid'];
$records = mysqli_query($conn,"SELECT * from products where bookid='$id'"); // fetch data from database
$data = mysqli_fetch_array($records);
$price= $_GET['book_price'];
$bookname=$data['book_name'] ;
$bookprice=$data['book_price'] ;
$bookimage=$data['book_image'] ;
$uid=$_GET['uid'];
$cart=mysqli_query($conn,"SELECT * from wish_list where book_id='$id' and uid='$uid'"); // fetch data from database
$cartdata = mysqli_fetch_array($cart);
$cartnum=mysqli_query($conn,"SELECT * FROM wish_list where uid='$uid'");
$cartnumdata=mysqli_num_rows( $cartnum);
/*echo $bookname ;
echo"<br>";
echo $bookprice;
echo"<br>";
echo $bookimage;
echo"<br>";
echo $id;
echo"<br>";
echo $uid;*/

if($cartdata>0)
{
    echo '<script type="text/javascript">';
    echo ' alert("already in the wish list");location.href="product.php?uid='.$uid.'&num='.$cartnumdata.'"';  
    echo '</script>';

}
else
{
    $query = "INSERT INTO wish_list(book_id, uid) VALUES('$id','$uid')";
    $data = mysqli_query($conn, $query);
    if($data)
    {
        header("location: product.php?uid=$uid&num=$cartnumdata");
    }
    else
    {
        echo "sorry something went wrong";
    }
}
?>