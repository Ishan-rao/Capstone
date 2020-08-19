<?php
$ip = get_ip();
$select_cart = mysqli_query($conn,"select *from cart where ip_address='$ip'");

$row_cart = mysqli_fetch_array($select_cart);

$result_product = mysqli_query($conn,"select *from products where productID='$row_cart[product_id]'");

$row_product = mysqli_fetch_array($result_product);

?>
<?php if(mysqli_num_rows($select_cart)==1){ ?>
<!-- real payment just use this down url -->
<!-- <form action="https://www.paypal.com/cgi-bin/webscr" method="post"> -->

<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
<!-- Identify your business so that you can collect the payments. -->
<input type="hidden" name="business" value="conestogapkg@gmail.com">

<!-- Specify a Buy Now button. -->
<input type="hidden" name="cmd" value="_xclick">

<!-- Specify details about the item that buyers will purchase. -->
<input type="hidden" name="item_name" value="<?php echo $row_product['product_title'];?>">
<input type="hidden" name="item_number" value="<?php echo $row_product['productID'];?>">
<input type="hidden" name="amount" value="<?php echo $row_product['product_price'];?>">
<input type="hidden" name="currency_code" value="USD">

<input type="hidden" name="return" value="http://localhost/darkstreet/payment-successful.php">
<input type="hidden" name="cancel_return" value="http://localhost/darkstreet/index.php">
<!-- Display the payment button. -->
<input type="image" name="submit" border="0" src="./images/checkout-logo-small.png" alt="Buy Now">
<img alt="" border="0" width="1" height="1"src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >

</form>
<?php }elseif(mysqli_num_rows($select_cart)>1){?>

    <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
<!-- Identify your business so that you can collect the payments. -->
<input type="hidden" name="business" value="conestogapkg@gmail.com">

<!-- Specify a Buy Now button. -->
<input type="hidden" name="cmd" value="_cart">
<input type="hidden" name = "upload" value="1">
<!-- Specify details about the item that buyers will purchase. -->
<input type="hidden" name="item_name_1" value="Static title 1">
<input type="hidden" name="item_number_1" value="1">
<input type="hidden" name="amount_1" value="250">
<input type="hidden" name="quantity_1" value="1">

<input type="hidden" name="item_name_2" value="Static title 2">
<input type="hidden" name="item_number_2" value="2">
<input type="hidden" name="amount_2" value="150">
<input type="hidden" name="quantity_2" value="2">

<input type="hidden" name="item_name_3" value="Static title 3">
<input type="hidden" name="item_number_3" value="3">
<input type="hidden" name="amount_3" value="100">
<input type="hidden" name="quantity_3" value="3">

<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="return" value="http://localhost/darkstreet/payment-successful.php">
<input type="hidden" name="cancel_return" value="http://localhost/darkstreet/index.php">
<!-- Display the payment button. -->
<input type="image" name="submit" border="0" src="./images/checkout-logo-small.png" alt="Buy Now">
<img alt="" border="0" width="1" height="1"src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >

</form>

<?php } ?>





















