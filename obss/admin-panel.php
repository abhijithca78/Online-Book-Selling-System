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
                <a href="admin-panel.php?aid=<?php echo $aid ?>" class="active">
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
                <a href="total_order.php?aid=<?php echo $aid ?>">
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
                dashboard
            </div>
        </div>
        <div class="main-content">
            <div class="row">
                <div class="col-3 col-md-6 col-sm-12">
                    <div class="box box-hover">
                        <!-- COUNTER -->
                        <div class="counter">
                            <div class="counter-title">
                                total order
                            </div>
                            <div class="counter-info">
                                <div class="counter-count">
                                    <?php echo $bnum ?>
                                </div>
                                <i class="bx bx-shopping-bag"></i>
                            </div>
                        </div>
                        <!-- END COUNTER -->
                    </div>
                </div>
                <div class="col-3 col-md-6 col-sm-12">
                    <div class="box box-hover">
                        <!-- COUNTER -->
                        <div class="counter">
                            <div class="counter-title">
                                conversion rate
                            </div>
                            <div class="counter-info">
                                <div class="counter-count">
                                    30.5%
                                </div>
                                <i class="bx bx-chat"></i>
                            </div>
                        </div>
                        <!-- END COUNTER -->
                    </div>
                </div>
                <div class="col-3 col-md-6 col-sm-12">
                    <div class="box box-hover">
                        <!-- COUNTER -->
                        <div class="counter">
                            <div class="counter-title">
                                total profit
                            </div>
                            <div class="counter-info">
                                <div class="counter-count">
                                    <?php echo $profit ?>
                                </div>
                                <i class="bx bx-line-chart"></i>
                            </div>
                        </div>
                        <!-- END COUNTER -->
                    </div>
                </div>
                <div class="col-3 col-md-6 col-sm-12">
                    <div class="box box-hover">
                        <!-- COUNTER -->
                        <div class="counter">
                            <div class="counter-title">
                                daily visitors
                            </div>
                            <div class="counter-info">
                                <div class="counter-count">
                                    690
                                </div>
                                <i class="bx bx-user"></i>
                            </div>
                        </div>
                        <!-- END COUNTER -->
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-3 col-md-6 col-sm-12">
                    <!-- TOP BOOKS -->
                    <div class="box f-height">
                        <div class="box-header">
                            TOP BOOKS
                        </div>
                        <div class="box-body">
                            <ul class="product-list">
                                <li class="product-list-item">
                                    <div class="item-info">
                                        <img src="images\dan brown.jpg" alt="product image">
                                        <div class="item-name">
                                            <div class="product-name">DAN BROWN</div>
                                            <div class="text-second">FICTIONAL</div>
                                        </div>
                                    </div>
                                    <div class="item-sale-info">
                                        <div class="text-second">Sales</div>
                                        <div class="product-sales">$5,930</div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- TOP PRODUCT -->
                </div>
                <div class="col-4 col-md-6 col-sm-12">
                    <!-- CATEGORY CHART -->
                    <div class="box f-height">
                        <div class="box-body">
                            <div id="category-chart"></div>
                        </div>
                    </div>
                    <!-- END CATEGORY CHART -->
                </div>
                <div class="col-5 col-md-12 col-sm-12">
                    <!-- CUSTOMERS CHART -->
                    <div class="box f-height">
                        <div class="box-header">
                            customers
                        </div>
                        <div class="box-body">
                            <div id="customer-chart"></div>
                        </div>
                    </div>
                    <!-- END CUSTOMERS CHART -->
                </div>
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
                                        <th>ID</th>
                                        <th>Customer</th>
                                        <th>Date</th>
                                        <th>Order status</th>
                                        <th>Payment status</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>

                                <?php
                                 while($data = mysqli_fetch_array($records))
                                 {
                                     $uid=$data['uid'] ;
                                 ?>
                                    <tr>
                                        <td><?php echo $data['id'] ?></td>
                                        <td>
                                            <?php
                                            $query=mysqli_query($conn,"SELECT * FROM `signup` WHERE id='$uid'");
                                            $run=mysqli_fetch_array($query);
                                            ?>
                                            <div class="order-owner">
                                                <img src="user_images/<?php echo $run['image']; ?>" alt="user image">
                                                <span><?php echo $data['name'] ?></span>
                                            </div>
                                        </td>
                                        <td><?php echo $data['date_added'] ?></td>
                                        <td>
                                            <span class="order-status order-ready">
                                            <?php echo $data['pay_status'] ?>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="payment-status payment-paid">
                                                <div class="dot"></div>
                                                <span> <?php echo $data['pay_status'] ?></span>
                                            </div>
                                        </td>
                                        <td>₹ <?php echo $data['amount'] ?></td>
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