<?php

 $apiKey = "GqYsvKixfNZl4dNCOwq1Jg72";

?>

<script src="https://code.jquery.com/jquery-3.5.0.js"></script>



<form action="" method="POST">
<script
    src="https://checkout.razorpay.com/v1/checkout.js"
    data-key="Enter the Key ID generated from the Dashboard" // Enter the Test API Key ID generated from Dashboard → Settings → API Keys
    data-amount="<?php echo $_POST['amount'] * 100;?>" // Amount is in currency subunits. Hence, 29935 refers to 29935 paise or ₹299.35.
    data-currency="INR"// You can accept international payments by changing the currency code. Contact our Support Team to enable International for your account
    data-id="<?php echo 'OID'.rand(10,100).'END';?>"//Replace with the order_id generated by you in the backend.
    data-buttontext="Pay with Razorpay"
    data-name="OBSS"
    data-description="PURCHASE"
    data-image="http://localhost/obss/razorpay/obss.png"
    data-prefill.name="<?php echo $_POST['name'];?>"
    data-prefill.email="<?php echo $_POST['email'];?>"
    data-prefill.contact="<?php echo $_POST['mobile'];?>"
    data-theme.color="#F37254"
></script>
<input type="hidden" custom="Hidden Element" name="hidden">
</form>
<script type="text/javascript">
    $(document).ready(function(){
        $('.razorpay-payment-button').click();
    });
</script> 
<style>
    .razorpay-payment-button { display: none; }
</style>    

<script type="text/javascript">
   

    //alert(response.razorpay_payment_id);
    "handler": function (response){
    alert(response.razorpay_payment_id);
    alert(response.razorpay_order_id);
    alert(response.razorpay_signature)}

    rzp1.on('payment.failed', function (response){    
    alert(response.error.code);    
    alert(response.error.description);
    alert(response.error.source);    
    alert(response.error.step);    
    alert(response.error.reason);    
    alert(response.error.metadata.order_id);    
    alert(response.error.metadata.payment_id);}
</script>  
   