<?php
session_start();

?>

<?php
 if(!isset($_SESSION['name']))
 {
     echo "you are logged out login again";
     header('location: adminlogin.php');
 }
 $bid=$_GET['id'];
 $aid=$_GET['aid'];
 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        OBSS Admin
    </title>
    <link rel="shortcut icon" href="/images/logo-mb.png" type="image/png">
    <!-- GOOGLE FONT -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <!-- BOXICONS -->
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet">
    <!-- APP CSS -->
    <link rel="stylesheet" href="./css/grid.css">
    <link rel="stylesheet" href="./css/app.css">
</head>

<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="sidebar-logo">
            <img src="./images/logo-lg.png" alt="Comapny logo">
            <div class="sidebar-close" id="sidebar-close">
                <i class="bx bx-left-arrow-alt"></i>
            </div>
        </div>
        <div class="sidebar-user">
            <div class="sidebar-user-info">
                <img src="images\abhijith.jpg" alt="User picture" class="profile-image">
                <div class="sidebar-user-name">
                <?php
                    if(isset($_SESSION['name']))
                    {
                      echo $_SESSION['name'];
                     
                    }
                ?>
                </div>
            </div>
            <a href="adminlogout.php">
            <button class="btn btn-outline">
                <i class="bx bx-log-out bx-flip-horizontal"></i>
            </button>
            </a>

        </div>
        <!-- SIDEBAR MENU -->
        <ul class="sidebar-menu">
            <li>
                <a href="#">
                    <i class="bx bx-home"></i>
                    <span>dashboard</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="bx bx-shopping-bag"></i>
                    <span>sales</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="bx bx-chart"></i>
                    <span>analytic</span>
                </a>
            </li>
            <li class="sidebar-submenu">
                <a href="#" class="sidebar-menu-dropdown">
                    <i class="bx bx-user-circle"></i>
                    <span>account</span>
                    <div class="dropdown-icon"></div>
                </a>
                <ul class="sidebar-menu sidebar-menu-dropdown-content">
                    <li>
                        <a href="#">
                            edit profile
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            account settings
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            billing
                        </a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-submenu" class="active">
                <a href="#" class="sidebar-menu-dropdown" class="active">
                    <i class="bx bx-category"></i>
                    <span>e-commerce</span>
                    <div class="dropdown-icon"></div>
                </a>
                <ul class="sidebar-menu sidebar-menu-dropdown-content"class="active">
                    <li>
                        <a href="list.php" class="active">
                            list product
                        </a>
                    </li>
                    <li>
                        <a href="add_product.php">
                            add product
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            orders
                        </a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-submenu">
                <a href="#" class="sidebar-menu-dropdown">
                    <i class="bx bx-cog"></i>
                    <span>settings</span>
                    <div class="dropdown-icon"></div>
                </a>
                <ul class="sidebar-menu sidebar-menu-dropdown-content">
                    <li>
                        <a href="#" class="darkmode-toggle" id="darkmode-toggle">
                            darkmode
                            <span class="darkmode-switch"></span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->


    <!-- MAIN CONTENT -->
    <div class="main">
        <div class="main-header">
            <div class="mobile-toggle" id="mobile-toggle">
                <i class="bx bx-menu-alt-right"></i>
            </div>
            <div class="main-title">
                add
            </div>
        </div>
        <div class="main-content">
            </div>
             
                    <!-- ORDERS TABLE -->
                    <div class="box">
                        <div class="box-header">
                            All Books
                        </div>
                        <div class="box-body overflow-scroll">
                            <table>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>book name</th>
                                        <th>price</th>
                                        <th>quantity</th>
                                        <th>author</th>
                                        <th>genre</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    include "dbconn.php"; // Using database connection file here

                                    $records = mysqli_query($conn,"select * from products where bookid = $bid"); // fetch data from database

                                    while($data = mysqli_fetch_array($records))
                                    {
                                    ?>
                                    <tr>
                                        <td><?php echo $data['bookid']; ?></td>
                                        <td>
                                            <div class="order-owner">
                                                <img src="book_image/<?php echo $data['book_image']; ?>" alt="user image">
                                                <span><?php echo $data['book_name']; ?></span>
                                            </div>
                                        </td>
                                        <td>Rs.<?php echo $data['book_price'];?></td>
                                        <td>
                                            <span class="order-status order-ready"><?php echo $data['book_qty']; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <div >
                                                <div></div>
                                                <span><?php echo $data['author_name']; ?></input></span>
                                            </div>
                                        </td>
                                        <td><?php echo $data['genre']; ?></td>
                                        
                                    </tr>
                                    <?php
                                    }
                                    ?>

                                </tbody>
                            </table>
                                        <form method="POST">
                                        <input type="text" name="qty" placeholder="Enter qty" >
                                        <input type="text" name="price" placeholder="Enter price">
                                        <input type="submit" name="update" value="Update">
                                        </form>
                        </div>
                    </div>
                    <!-- END ORDERS TABLE -->
                </div>

                <?php

                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $dbname = "obss";

                        $conn = mysqli_connect($servername, $username, $password, $dbname);

                        $id = $_GET['id']; // get id through query string

                        $qry = mysqli_query($conn,"select * from products where bookid='$id'"); // select query

                        $data = mysqli_fetch_array($qry); // fetch data

                        if(isset($_POST['update'])) // when click on Update button
                        {
                            $qty = $_POST['qty'];
                            $price = $_POST['price'];
                            
                            if($price&&$qty)
                            {
                                $edit = mysqli_query($conn,"UPDATE products set book_price='$price', book_qty='$qty' where bookid='$id'");
                            }
                            elseif($qty)
                            {
                                $edit = mysqli_query($conn,"UPDATE products set book_qty='$qty' where bookid='$id'");
                            }
                            elseif($price)
                            {
                                $edit = mysqli_query($conn,"UPDATE products set book_price='$price' where bookid='$id'");
                            }
                            else
                            {
                                echo '<script language="javascript">';
                                echo 'alert("please enter details"); location.href="http://localhost/obss/list.php?aid='.$aid.'"';
                                echo '</script>'; // redirects to all records page
                                exit;
                            }
                            
                            if($edit)
                            {
                                mysqli_close($conn); // Close connection
                                echo '<script language="javascript">';
                                echo 'alert("Successfully updated"); location.href="http://localhost/obss/list.php?aid='.$aid.'"';
                                echo '</script>'; // redirects to all records page
                                exit;
                            }
                            else
                            {
                                mysqli_close($conn); // Close connection
                                echo '<script language="javascript">';
                                echo 'alert("error updating"); location.href="http://localhost/obss/list.php?aid='.$aid.'"';
                                echo '</script>'; // redirects to all records page
                                exit;
                            }    	
                        }
                ?>       
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT -->

    <div class="overlay"></div>

    <!-- SCRIPT -->
    <!-- APEX CHART -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <!-- APP JS -->
    <script src="javascript\app.js"></script>

</body>

</html>