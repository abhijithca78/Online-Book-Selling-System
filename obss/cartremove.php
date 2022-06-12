<?php

include "dbconn.php";


$uid=$_GET['uid'];
$bookid=$_GET['bookid'];
$records = mysqli_query($conn,"DELETE cart.* FROM cart, products WHERE cart.book_id = products.bookid and cart.userid='$uid' and cart.book_id='$bookid'");
if($records)
{
    header("location: cart.php?uid=$uid");
}
?>