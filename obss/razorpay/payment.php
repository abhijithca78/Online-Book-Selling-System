<?php
include "C:/xampp/htdocs/obss/dbconn.php";

if(isset($_POST['pay_id']))
{
    $pay_id= $_POST['pay_id'];
    $amount= $_POST['amount'];
    $name= $_POST['name'];
    $uid=$_POST['uid'];

    $query = "INSERT INTO `razorpay` (`name`, `amount`, `pay_id`, `pay_status`, `date_added`,`uid`) VALUES ('$name','$amount','$pay_id','sucess', current_timestamp(),'$uid');";
    $queryrun=mysqli_query($conn, $query);
    
    if($queryrun)
    {
if(isset($_POST['pay_id']))
$query1 = "INSERT INTO `orders`() SELECT * FROM `razorpay` WHERE pay_id = '$pay_id';";
        mysqli_query($conn, $query1);

        $query6=mysqli_query($conn,"INSERT INTO `my_orders`() SELECT * FROM `cart` WHERE userid = '$uid';");

        $query3 = "SELECT * FROM `cart` WHERE `userid`='$uid'";
        $query3run=mysqli_query($conn, $query3);
        while($data = mysqli_fetch_assoc($query3run))
        {
            $bid=$data['book_id'];
            $qty=$data['qty'];
            $query4="SELECT * FROM `products` WHERE `bookid`='$bid'";
            $query4run=mysqli_query($conn, $query4);
            $data1 = mysqli_fetch_assoc($query4run);
            
                $oldqty=$data1['book_qty'];
                $newqty= $oldqty - $qty;
                
                $query5="UPDATE `products` SET `book_qty`='$newqty' WHERE `bookid`= '$bid'";
                mysqli_query($conn, $query5);
            


        }

        $query2 = "DELETE FROM `cart` WHERE userid ='$uid';";
        mysqli_query($conn, $query2);
    }
}


if(isset($_POST['qty']))
{
    $pid= $_POST['pid'];
    $qty=$_POST['qty'];
    $uid=$_POST['uid'];

    $query = "UPDATE `cart` SET `qty`='$qty' WHERE `book_id`= $pid && `userid`=$uid";
    mysqli_query($conn, $query);

}

?>