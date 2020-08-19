<?php 
session_start(); 
include './functions/functions.php';
?>
<?php
if(!empty($_GET['tx'])){

$amount = $_GET['amt'];
$item_number = $_GET['item_number'];
$transaction_id = $_GET['tx'];
$currency_code = $_GET['cc'];
$payment_status = $_GET['st'];
//check if payment data exists with the same transaction ID

$check_previous_payment = mysqli_query($conn,"select payment_id from payments where tx_id='$transaction_id'");
if(mysqli_num_rows($check_previous_payment)>0){


}else{

    $ip = get_ip();

    $select_cart = mysqli_query($conn,"select quantity from cart where ip_address='$ip' and product_id='$item_number'");
    $fetch_cart = mysqli_fetch_array($select_cart);
    $quantity = $fetch_cart['quantity'];
    $date = date("F/d/Y");
    $invoice_id = mt_rand();
    //inserting payment data to database

    $insert_payment = mysqli_query($conn,"insert into payments (tx_id,product_id,buyer_id,currency_code,payment_status,payer_email,quantity,amount,date,type,payment_type,invoice_id)
                         values('$transaction_id','$item_number','$_SESSION[user_id]','$currency_code','$payment_status','$_SESSION[email]','$quantity','$amount','$date','single_item','paypal','$invoice_id')");


        //deleting products from cart
        $remove_cart = mysqli_query($conn,"delete from cart where product_id='$item_number' and ip_address='$ip'");
   }
//check if paypal paymeny is successful

$payment_result = mysqli_query($conn,"select *from payments where tx_id='$transaction_id'");
if(mysqli_num_rows($payment_result)>0){

?>
<!doctype html>
<html lang="en">

  <head>
  <title style="color:red">Dark Street</title> 
    
    <link rel="shortcut icon" href="../images/logo3.ico">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.0/animate.min.css"> -->
    <!-- Font Awesome -->
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.0/css/mdb.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Holtwood+One+SC&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.0/animate.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
    <body>
        
    <div class="container">
        <div class="card mt-2">
            <div class="card-body">
                
                <h3 class="text-center">
                <img src="images/suucess-icon.png" style="height:100px;width:100px;text-align:center;border-radius:100px" alt="">    
                 Your purchase has been done successfully.
                </h3>
                <div class="text-center">
                <p>Your Email : <?php if(isset($_SESSION['email'])){echo $_SESSION['email'];}?></p>
                <i class="fas fa-arrow-left text-primary" ></i><a href="http://localhost/darkstreet/index.php"> Continue Shopping</a>
                </div>
                <div style="text-align:center">
                    <img src="images/thank-you-with-character-vector_2029-149.jpg" height="450px" width="350px" alt="">
                </div>
            </div>
        </div>
    </body>
    </html>
<!--Mailing to customer-->
<?php
$to = $_SESSION['email'];
$subject = "Order Details";

$message = "
<html>
<head>
<title>HTML email</title>
</head>
<body>
<p>This email contains HTML Tags!</p>
<table>
<tr>
<th>Firstname</th>
<th>Lastname</th>
</tr>
<tr>
<td>John</td>
<td>Doe</td>
</tr>
</table>
</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: pkg.message@gmail.com' . "\r\n";


mail($to,$subject,$message,$headers);
?>

<!--Mailing ends-->
<?php } ?>
<?php }else{ ?>

<!doctype html>
<html lang="en">

  <head>
  <title style="color:red">Dark Street</title> 
    
    <link rel="shortcut icon" href="../images/logo3.ico">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.0/animate.min.css"> -->
    <!-- Font Awesome -->
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.0/css/mdb.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Holtwood+One+SC&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.0/animate.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
    <body>
    <div class="container">
        <div class="card mt-2">
            <div class="card-body">
                
                <h3 class="text-center">
                <img src="images/payment_error.jpg" style="height:100px;width:160px;text-align:center;border-radius:100px" alt="">    
                 Your purchase has been failed.
                </h3>
                <div class="text-center">
                <i class="fas fa-arrow-left text-primary" ></i><a href="http://localhost/darkstreet/cart.php"> Back to Cart</a>
                </div>
                <div style="text-align:center">
                    <img src="images/error-character.jpg" height="200px" width="200px" alt="">
                </div>
            </div>
        </div>
</body>
<?php } ?>

