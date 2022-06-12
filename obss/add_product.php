<?php
session_start();

?>

<?php
 if(!isset($_SESSION['name']))
 {
     echo "you are logged out login again";
     header('location: adminlogin.php');
 }
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

    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    
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
                <a href="admin-panel.php?aid=<?php echo $aid ?>">
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
            <li >
                <a href="total_users.php?aid=<?php echo $aid ?>">
                    <i class="bx bx-user-circle"></i>
                    <span>users</span>
                </a>
            </li>
            <li class="sidebar-submenu" class="active">
                <a href="#" class="sidebar-menu-dropdown" class="active">
                    <i class="bx bx-category"></i>
                    <span>e-commerce</span>
                    <div class="dropdown-icon"></div>
                </a>
                <ul class="sidebar-menu sidebar-menu-dropdown-content"class="active">
                    <li>
                        <a href="list.php?aid=<?php echo $aid ?>" >
                            list product
                        </a>
                    </li>
                    <li>
                        <a href="add_product.php?aid=<?php echo $aid ?>" class="active">
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
        
        <div class="main-content">
            </div>
<form action="http://localhost/obss/add_product_code.php?aid=<?php echo $aid ?>" method="POST" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
                    <!-- ORDERS TABLE -->
                    <div class="form-group">
  <label class="col-md-4 control-label" for="product_name">BOOK NAME</label>  
  <div class="col-md-4">
  <input id="product_name" name="product_name" placeholder="PRODUCT NAME" class="form-control input-md" required type="text">
    
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="product_categorie">PRODUCT CATEGORY</label>
  <div class="col-md-4">
  <label for="cars">Choose a genre:</label>
  <select required name="genre" id="genre">
    <option value="Action and adventure">Action and adventure</option>
    <option value="Art/architecture">Art/architecture</option>
    <option value="Alternate history">Alternate history</option>
    <option value="Autobiography">Autobiography</option>
    <option value="Anthology">Anthology</option>
    <option value="Biography">Biography</option>
    <option value="Business/economics">Business/economics</option>
    <option value="Children's">Children's</option>
    <option value="Crafts/hobbies">Crafts/hobbies</option>
    <option value="Classic">Classic</option>
    <option value="Cookbook">Cookbook</option>
    <option value="Comic book">Comic book</option>
    <option value="Diary">Diary</option>
    <option value="Coming-of-age">Coming-of-age</option>
    <option value="Dictionary">Dictionary</option>
    <option value="Crime">Crime</option>
    <option value="Encyclopedia">Encyclopedia</option>
    <option value="Drama">Drama</option>
    <option value="Guide">Guide</option>
    <option value="Fairytale">Fairytale</option>
    <option value="Health/fitness">Health/fitness</option>
    <option value="Fantasy">Fantasy</option>
    <option value="History">History</option>
    <option value="Graphic novel">Graphic novel</option>
    <option value="Home and garden">Home and garden</option>
    <option value="Historical fiction">Historical fiction</option>
  </select>  
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="available_quantity">AVAILABLE QUANTITY</label>  
  <div class="col-md-4">
  <input id="available_quantity" name="available_quantity" placeholder="AVAILABLE QUANTITY" class="form-control input-md" required type="number">
    
  </div>
</div>

<!-- Textarea -->
<div class="form-group">
  <label class="col-md-4 control-label" for="product_description">PRODUCT DESCRIPTION</label>
  <div class="col-md-4">                     
    <textarea required class="form-control" id="product_description" name="product_description"></textarea>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="online_date">PRICE</label>  
  <div class="col-md-4">
  <input id="online_date" name="price" placeholder="ONLINE DATE" class="form-control input-md" required type="number">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="author">AUTHOR</label>  
  <div class="col-md-4">
  <input id="author" name="author" placeholder="AUTHOR" class="form-control input-md" required type="text">
    
  </div>
</div>
    
 <!-- File Button --> 
<div class="form-group">
  <label class="col-md-4 control-label" for="filebutton">Book image</label>
  <div class="col-md-4">
    <input required id="filebutton" name="bookimage" class="input-file" type="file">
  </div>
</div>

<!-- Button -->
<div class="form-group">
<label class="col-md-4 control-label" for="singlebutton">SUBMIT</label>
  <div class="col-md-4">
    <button id="singlebutton" name="singlebutton" class="btn btn-primary">ADD</button>
  </div>
  </div>

</fieldset>
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