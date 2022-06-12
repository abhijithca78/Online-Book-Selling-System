<?php
session_start();
?>

<?php
$uid=$_GET['uid'];
 if(!isset($_SESSION['uname']))
 {
     echo "you are logged out login again";
     header('location: userlogin.php');
 }
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- Favicon -->
  <link rel="shortcut icon" href="./images/favicon.ico" type="image/x-icon">

  <!-- Box icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" />

  <!-- Glidejs -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Glide.js/3.4.1/css/glide.core.css" />
  <!-- Custom StyleSheet -->
  <link rel="stylesheet" href="css/cart.css" />
  <title>OBSS</title>
</head>

<body>
  <!-- Navigation -->
  <nav class="nav">
    <div class="navigation container">
      <div class="logo">
        <h1>OBSS</h1>
      </div>
      <?php
      if(isset($_SESSION['uname']))
                    {
                      echo $_SESSION['status'];
                      echo $_SESSION['uname'];
                      
                    }
      ?>              
      <div class="menu">
        <div class="top-nav">
          <div class="logo">
            <h1>OBSS</h1>
          </div>
          <div class="close">
            <i class="bx bx-x"></i>
          </div>
        </div>

        <ul class="nav-list">
          <li class="nav-item">
            <a href="product.php?uid=<?php echo $uid;?>" class="nav-link">Home</a>
          </li>
         
          <li class="nav-item">
            <a href="#about" class="nav-link">About</a>
          </li>
          <li class="nav-item">
            <a href="contact1.php" class="nav-link">Contact</a>
          </li>
          <li class="nav-item">
            <a href="Wishlist_profile.php" class="nav-link">Account</a>
          </li>
          <li class="nav-item">
            <a href="cart.php" class="nav-link icon"><i class="bx bx-shopping-bag"></i></a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link icon"><i class="bx bx-log-out"></i></a>
          </li>
        </ul>
      </div>

      <a href="cart.php" class="cart-icon">
        <i class="bx bx-shopping-bag"></i>
      </a>

      <div class="hamburger">
        <i class="bx bx-menu"></i>
      </div>
    </div>
  </nav>

  <!-- Product Details -->
  <section class="section product-detail">
    <div class="details container-md">
      <div class="left">
      <?php
          include "dbconn.php"; // Using database connection file here
          $id=$_GET['bookid'];
          $records = mysqli_query($conn,"select * from products where bookid ='$id'") or die( mysqli_error($conn)); // fetch data from database
         
         
          while($data = mysqli_fetch_array($records))
          {
            $author = $data['author_name'];
          ?>
        <div class="main">
          <img src="book_image/<?php echo $data['book_image']; ?>" alt="">
        </div>
        
      </div>
      <div class="right">
        <span><?php echo $data['author_name']; ?></span>
        <h1><?php echo $data['book_name']; ?></h1>
        <div class="price"><?php echo $data['book_price']; ?></div>
        <form>
          <div>
            <span><i class="bx bx-chevron-down"></i></span>
          </div>
          <a href="cartbackend.php?bookid=<?php echo $data['bookid']; ?>&book_price=<?php echo $data['book_price']; ?>&uid=<?php echo $uid ?>" class="addCart">Add To Cart</a>
        </form>
          
        </form>
        <h3>Product Detail</h3>
        <p><?php
        echo $data['description'];
        ?></p>
      </div>
      <?php
      }
    
      ?>
    </div>
  </section>

  <!-- Related -->
  <section class="section featured">
    <div class="top container">
      <h1>All Books</h1>
      <a href="#" class="view-more">View more</a>
    </div>

    <div class="product-center container">
      
      
      
    <?php
                include "dbconn.php"; // Using database connection file here

                $records = mysqli_query($conn,"select * from products where author_name = '$author'"); // fetch data from database
                if($records)
                {
                while($data = mysqli_fetch_array($records))
                {
                ?>
        
            <div class="product">
                <div class="product-header">
                    <img src="book_image/<?php echo $data['book_image']; ?>" alt="">
                    <ul class="icons">
                        <span><i class="bx bx-heart"></i></span>
                        <a href="cart.php?bookid=<?php echo $data['bookid']; ?>"> <span><i class="bx bx-shopping-bag"></i></span>
                        </a>
                        <a href="product-details.php?bookid=<?php echo $data['bookid'];?>&uid=<?php echo $uid;?>"><span><i class="bx bx-search"></i></span>
                        </a>
                    </ul>
                </div>
                <div class="product-footer">
                    <a href="product-details.php?bookid=<?php echo $data['bookid']; ?>">
                        <h3><?php echo $data['book_name']; ?></h3>
                    </a>
                    <div class="rating">
                        <i class="bx bxs-star"></i>
                        <i class="bx bxs-star"></i>
                        <i class="bx bxs-star"></i>
                        <i class="bx bxs-star"></i>
                        <i class="bx bx-star"></i>
                    </div>
                    <h4 class="price">Rs.<?php echo $data['book_price']; ?></h4>
                </div>
            </div>
            <?php
            }
          }
            ?>
    </div>
  </section>

  <!-- Footer -->
  <footer id="footer" class="section footer">
    <div class="container">
      <div class="footer-container">
        <div class="footer-center">
          <h3>EXTRAS</h3>
          <a href="#">Brands</a>
          <a href="#">Gift Certificates</a>
          <a href="#">Affiliate</a>
          <a href="#">Specials</a>
          <a href="#">Site Map</a>
        </div>
        <div class="footer-center">
          <h3>INFORMATION</h3>
          <a href="#">About Us</a>
          <a href="#">Privacy Policy</a>
          <a href="#">Terms & Conditions</a>
          <a href="#">Contact Us</a>
          <a href="#">Site Map</a>
        </div>
        <div class="footer-center">
          <h3>MY ACCOUNT</h3>
          <a href="#">My Account</a>
          <a href="#">Order History</a>
          <a href="#">Wish List</a>
          <a href="#">Newsletter</a>
          <a href="#">Returns</a>
        </div>
        <div class="footer-center">
          <h3>CONTACT US</h3>
          <div>
            <span>
              <i class="fas fa-map-marker-alt"></i>
            </span>
            42 Dream House, Dreammy street, 7131 Dreamville, USA
          </div>
          <div>
            <span>
              <i class="far fa-envelope"></i>
            </span>
            company@gmail.com
          </div>
          <div>
            <span>
              <i class="fas fa-phone"></i>
            </span>
            456-456-4512
          </div>
          <div>
            <span>
              <i class="far fa-paper-plane"></i>
            </span>
            Dream City, USA
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- End Footer -->

  <!-- GSAP -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/gsap.min.js"></script>
  <!-- Custom Script -->
  <script src="javascript/cart.js"></script>
</body>

</html>