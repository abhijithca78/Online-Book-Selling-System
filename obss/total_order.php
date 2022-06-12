<?php
session_start();
include "dbconn.php"; // Using database connection file here


?>


<?php

    $profit=0;                   
    $num=mysqli_query($conn,"SELECT * FROM `orders` WHERE MONTH(`date_added`) = MONTH(CURRENT_DATE()) AND YEAR(`date_added`) = YEAR(CURRENT_DATE());");
    $num2=mysqli_query($conn,"SELECT * FROM `orders`");
    $numdata=mysqli_num_rows( $num);
    if($numdata==0)
    {
        $bnum= 0;
    }
    else
    {
        $bnum= $numdata;

        while($res=mysqli_fetch_array($num2))
        {
            $amt=$res['amount'];
            $profit=$profit + $amt;
        }
    }
    ?>



<?php
 if(!isset($_SESSION['name']))
 {
     echo "you are logged out login again";
     header('location: adminlogin.php');
 }
 $aid=$_GET['aid'];
 $records = mysqli_query($conn,"SELECT * FROM `orders` WHERE MONTH(`date_added`) = MONTH(CURRENT_DATE()) AND YEAR(`date_added`) = YEAR(CURRENT_DATE());"); 
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
                <a href="admin-panel.php?aid=<?php echo $aid ?>" >
                    <i class="bx bx-home"></i>
                    <span>dashboard</span>
                </a>
            </li>
            <li>
                <a href="total_sales.php?aid=<?php echo $aid ?>">
                    <i class="bx bx-shopping-bag"></i>
                    <span>sales</span>
                </a>
            </li>
            <li>
                <a href="total_order.php?aid=<?php echo $aid ?>" class="active">
                    <i class="bx bx-chart"></i>
                    <span>analytic</span>
                </a>
            </li>
            <li class="active">
                <a href="total_users.php?aid=<?php echo $aid ?>">
                    <i class="bx bx-user-circle"></i>
                    <span>users</span>
                </a>
            </li>
            <li class="sidebar-submenu">
                <a href="#" class="sidebar-menu-dropdown">
                    <i class="bx bx-category"></i>
                    <span>e-commerce</span>
                    <div class="dropdown-icon"></div>
                </a>
                <ul class="sidebar-menu sidebar-menu-dropdown-content">
                    <li>
                        <a href="list.php?aid=<?php echo $aid ?>">
                            list product
                        </a>
                    </li>
                    <li>
                        <a href="add_product.php">
                            add product
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="user_added_books.php?aid=<?php echo $aid ?>">
                    <i class="bx bx-check-double"></i>
                    <span>allow products</span>
                </a>
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
                Total Orders
            </div>
        </div>
        <div class="main-content">
            <div class="row">
                <div class="col-12">
                    <!-- ORDERS TABLE -->
                    <div class="box">
                        <div class="box-header">
                            Recent orders
                        </div>
                        <div class="box-body overflow-scroll">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Book ID</th>
                                        <th>Book Name</th>
                                        <th>User ID</th>
                                        <th>Date</th>
                                        <th>Order status</th>
                                        <th>Payment status</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total Paid</th>
                                    </tr>
                                </thead>
                                <tbody>

                                <?php 


                                $records = mysqli_query($conn,"SELECT my_orders.*, products.* FROM my_orders, products WHERE my_orders.book_id = products.bookid"); // fetch data from database
                                

                                while($data = mysqli_fetch_array($records))
                                {
                                    $price=$data['qty'] * $data['book_price'];
                                ?>
                                    <tr>
                                        <td><?php echo $data['bookid'] ?></td>
                                        <td>
                                            <div class="order-owner">
                                                <img src="book_image/<?php echo $data['book_image']; ?>" alt="user image">
                                                <span><?php echo $data['book_name']; ?></span>
                                            </div>
                                        </td>
                                        <td><?php echo $data['userid'] ?></td>
                                        <td><?php echo $data['time'] ?></td>
                                        <td>
                                            <span class="order-status order-ready">
                                            SUCCESS
                                            </span>
                                        </td>
                                        <td>
                                            <div class="payment-status payment-paid">
                                                <div class="dot"></div>
                                                <span> SUCCESS</span>
                                            </div>
                                        </td>
                                        <td>₹ <?php echo $data['book_price'] ?></td>
                                        <td><?php echo $data['qty'] ?> .Pcs</td>
                                        <td>₹ <?php echo $price ?></td>
                                    </tr>
                                   
                                    <?php
                                 }
                                 ?>
                                   
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END ORDERS TABLE -->
                </div>
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
<script src="https://apps.elfsight.com/p/platform.js" defer></script>
<div class="elfsight-app-95105298-ac33-4365-bd1d-9ad388438c49"></div>