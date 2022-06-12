<?php
session_start();

include "dbconn.php";

$uid=$_GET['uid'];

$query=mysqli_query($conn,"DELETE FROM `wish_list` WHERE `uid`='$uid'");

if($query)
{
    mysqli_close($conn); // Close connection
    echo '<script language="javascript">';
    echo 'alert("Successfully Cleared your Wishlist"); location.href="http://localhost/obss/Wishlist_profile.php?uid='.$uid.'"';
    echo '</script>'; // redirects to all records page
    exit;
}
else
{
    mysqli_close($conn); // Close connection
    echo '<script language="javascript">';
    echo 'alert("Error Clearing your Wishlist"); location.href="http://localhost/obss/Wishlist_profile.php?uid='.$uid.'"';
    echo '</script>'; // redirects to all records page
    exit;
}

?>