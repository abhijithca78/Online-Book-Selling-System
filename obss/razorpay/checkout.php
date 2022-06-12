<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<style>
body {
  font-family: Arial;
  font-size: 17px;
  padding: 8px;
}

* {
  box-sizing: border-box;
}

.row {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE10 */
  flex-wrap: wrap;
  margin: 0 -16px;
}

.col-25 {
  -ms-flex: 25%; /* IE10 */
  flex: 25%;
}

.col-50 {
  -ms-flex: 50%; /* IE10 */
  flex: 50%;
}

.col-75 {
  -ms-flex: 75%; /* IE10 */
  flex: 75%;
}

.col-25,
.col-50,
.col-75 {
  padding: 0 16px;
}

.container {
  background-color: #f2f2f2;
  padding: 5px 20px 15px 20px;
  border: 1px solid lightgrey;
  border-radius: 3px;
}

input[type=text] {
  width: 100%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

label {
  margin-bottom: 10px;
  display: block;
}

.icon-container {
  margin-bottom: 20px;
  padding: 7px 0;
  font-size: 24px;
}

.btn {
  background-color: #4CAF50;
  color: white;
  padding: 12px;
  margin: 10px 0;
  border: none;
  width: 100%;
  border-radius: 3px;
  cursor: pointer;
  font-size: 17px;
}

.btn:hover {
  background-color: #45a049;
}

a {
  color: #2196F3;
}

hr {
  border: 1px solid lightgrey;
}

span.price {
  float: right;
  color: grey;
}

/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (also change the direction - make the "cart" column go on top) */
@media (max-width: 800px) {
  .row {
    flex-direction: column-reverse;
  }
  .col-25 {
    margin-bottom: 20px;
  } 
}
</style>
</head>
<body>
 <?php

 include "C:/xampp/htdocs/obss/dbconn.php";
  $price= $_COOKIE["amount"]; 
  $tax=$_COOKIE["tax"]; 
  $amount=$price+$tax;
  $uid=$_GET['id'];
  $hidname=mysqli_query($conn,"SELECT * FROM signup where id='$uid'");
  $hidusernameout=mysqli_fetch_assoc($hidname);
  $u_hidname=$hidusernameout['firstname'];
  $u_hidemail=$hidusernameout['email'];
  $u_hidnumber=$hidusernameout['phone'];
?>

<div class="row"  style="padding:100px 300px;">
  <div class="col-50">
    <div class="container" >
      <form style="padding: 25px;">
      
        <div class="row" >
          <div class="col-25">
            <h3 style="text-align: center;margin:20px 10px;font-family: lato;">Checkout Form</h3>
          

            <label for="fname"><i class="fa fa-user"></i> Full Name</label>
            <input type="text" id="name" name="name" value="<?php echo $u_hidname;?>">
            <label for="email"><i class="fa fa-envelope"></i> Email</label>
            <input type="text" id="email" name="email" value ="<?php echo $u_hidemail;?>">
            <input type="hidden" value="<?php echo 'OID'.rand(100,1000);?>" name="orderid">
            <input type="hidden" value="<?php echo 1;?>" name="amount">
            <label for="city"><i class="fa fa-mobile"></i> Mobile</label>
            <input type="text" id="city" name="mobile" value ="<?php echo $u_hidnumber;?>">
            <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
            <input type="text" id="adr" name="address" value ="<?php echo $u_hidnumber;?>">
            


          
        </div>
       
        <input type="button" class="btn" value="Pay Now" onclick="MakePayment()">
      </form>
    </div>
  </div>
 
</div>

</body>
</html>
<script>
  function MakePayment(){
    var name=$("#name").val();
    var amount=<?php echo $amount ?>;
    var uid=<?php echo $uid ?>;
    var options = {
    "key": "// Enter the Key ID generated from the Dashboard", // Enter the Key ID generated from the Dashboard
    "amount": amount*100, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
    "currency": "INR",
    "name": name,
    "description": "test transaction",
    "image": "http://localhost/obss/razorpay/obss.png",
    //"order_id": "order_9A33XWu170gUtm", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
    "handler": function (response){
       jQuery.ajax({
         type:"POST",
         url:"payment.php",
         data:"pay_id="+response.razorpay_payment_id+"&amount="+amount+"&name="+name+"&uid="+uid,
        success:function(result)
        {
           window.location.href="success.php?uid=<?php echo $uid ?>";  
        }
         
        });
    },
    "prefill": {
        "name": "<?php echo $u_hidname;?>" ,
        "email": "<?php echo $u_hidemail;?>",
        "contact": "<?php echo $u_hidnumber;?>"
    },
    "notes": {
        "address": "Razorpay Corporate Office"
    },
    "theme": {
        "color": "#6f68e3"
    }
};
var rzp1 = new Razorpay(options);
rzp1.open();

}
</script>


