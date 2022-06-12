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
 include "dbconn.php";
 $value;
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

  <!-- Custom StyleSheet -->
  <link rel="stylesheet" href="css\cart.css" />
  <title>Your Cart</title>
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
            <a href="product.php?uid=<?php echo$uid;?>" class="nav-link">Home</a>
          </li>
         
          <li class="nav-item">
            <a href="#about" class="nav-link">About</a>
          </li>
          <li class="nav-item">
            <a href="contact1.php" class="nav-link">Contact</a>
          </li>
          <li class="nav-item">
            <a href="Wishlist_profile.php?uid=<?php echo$uid;?>" class="nav-link">Account</a>
          </li>
          <li class="nav-item">
          <a href="cart.php?uid=<?php echo $uid;?>" class="nav-link icon"><i class="bx bx-shopping-bag">
                        </i>
                        <span class="cart-basket d-flex align-items-center justify-content-center">            
                        <?php
                        
                        $cartnum=mysqli_query($conn,"SELECT * FROM cart where userid='$uid'");
                        $cartnumdata=mysqli_num_rows( $cartnum);
                        if($cartnumdata==0)
                        {
                          echo $cartnumdata;
                          $tax=0;
                        }
                        else
                        {
                        $cartnumresult = mysqli_fetch_array($cartnum);
                        $bid= $cartnumresult['book_id'];
                        echo $cartnumdata;
                        $tax=50;
                        }
                        ?>
                        </span></a>
          </li>
          <li class="nav-item">
            <a href="logout.php" class="nav-link icon"><i class="bx bx-log-out"></i></a>
          </li>
        </ul>
      </div>

      <a href="cart.html" class="cart-icon">
        <i class="bx bx-shopping-bag"></i>
      </a>

      <div class="hamburger">
        <i class="bx bx-menu"></i>
      </div>
    </div>
  </nav>

  <!-- Cart Items -->
  <div class="container-md cart">
  <form action="razorpay\checkout.php?id=<?php echo $uid ?>" method="POST">
    <table>
      <tr>
        <th>Product</th>
        <th>price</th>
        <th></th>
        <th>Quantity</th>
        <th>Subtotal</th>
      </tr>
      <?php

                include "dbconn.php"; // Using database connection file here
                
                $records = mysqli_query($conn,"SELECT cart.*, products.* FROM cart, products WHERE cart.book_id = products.bookid and cart.userid='$uid'"); // fetch data from database
                $totalrun=mysqli_query($conn,"SELECT sum(products.book_price) as total_sum FROM cart, products WHERE cart.book_id = products.bookid and cart.userid='$uid'");
                $row = mysqli_fetch_assoc($totalrun);
                if($records)
                {
                  
                 
                while($data = mysqli_fetch_array($records))
                {
                ?>
      <tr>
        <td>
          <div class="cart-info">
            <img src="book_image/<?php echo $data['book_image']; ?>" alt="">
            <div>
              <p><?php echo $data['book_name']; ?></p>
              <span></span>
              <br />
              <a href="cartremove.php?bookid=<?php echo $data['bookid']; ?>&uid=<?php echo $uid ?>">remove</a>
            </div>
          </div>
        </td>
        <td><?php echo $data['book_price']; 
        $a = $data['book_price'];?><input type="hidden" name="pr" class="iprice" id="pr" value="<?php echo $data['book_price'] ?>">
        <td>
        <input type="hidden" name="uid" class="uid" id="uid" value="<?php echo $uid ?>">
        <input type="hidden" name="bid" class="bid" id="bid" value="<?php echo $data['bookid']; ?>">
        <td>
        <input name='iquantity' id='iquantity' type="number" class= 'iquantity' value = "<?php echo $data['qty']; ?>" onchange='subtotal()' name="no" min="0" max="<?php echo $data['book_qty']; ?>" >
        </td>
        <td class = 'itotal'></td>
      </tr>
      <?php
      }
    }
      ?>
    </table>

    <div class="total-price">
      <table>
        <tr>
          <td>Subtotal</td>
          <td id="stotal"></td>
        </tr>
        <tr>
          <td>Tax</td>
          <td>Rs.<?php echo $tax ?></td>
        </tr>
        <tr>
          <td>Total</td>
          <td name='gtotal' id="gtotal"></td>
        </tr>
      </table>
      <button class="checkout btn submit" name="submit" id="submit">Proceed To Checkout</button>

    </div>

    </form>

  </div>
            

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
            44/4, Mavalli Tank Bund Road, Journalist Colony
          </div>
          <div>
            <span>
              <i class="far fa-envelope"></i>
            </span>
            @gmail.com
          </div>
          <div>
            <span>
              <i class="fas fa-phone"></i>
            </span>
            080-26708149
          </div>
          <div>
            <span>
              <i class="far fa-paper-plane"></i>
            </span>
            Bangalore, INDIA
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- End Footer -->

  
 
  <!-- GSAP -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/gsap.min.js"></script>
  <!-- Custom Script -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>  
    var st=0;
    var dr=0;
    var tax=<?php echo $tax ?>;
    var iprice=document.getElementsByClassName('iprice');
    var iquantity=document.getElementsByClassName('iquantity');
    var itotal=document.getElementsByClassName('itotal');
    var stotal=document.getElementById('stotal');
    var gtotal=document.getElementById('gtotal');
    var grand=document.getElementById('amount');
    var uid=1;


    function subtotal()
    {
      st=0;
      for(i=0;i<iprice.length;i++)
      {
        itotal[i].innerText =(iprice[i].value)*(iquantity[i].value);
        st=st+(iprice[i].value)*(iquantity[i].value);
        console.log(iquantity[i].value);
      }
      stotal.innerText=st;
      gtotal.innerText=st+tax;
      document.cookie='amount='+st;
      document.cookie='tax='+tax;
      
    }

    subtotal();

  </script> 

  <script type='text/javascript'>

  $(document).ready(function(){
      $(".iquantity").on('change', function(){
        var $el= $(this).closest('tr');

        var bid= $el.find(".bid").val();
        var uid= $el.find(".uid").val();
        var qty= $el.find(".iquantity").val();
        
        $.ajax({
          url:'razorpay/payment.php',
          method: 'POST',
          cache: false,
          data: {qty:qty,pid:bid,uid:uid},
          success: function(response){
            console.log(response);
          }
        });
      });
     
    });

  </script>


</body>
</html> 