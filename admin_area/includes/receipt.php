<h1>RECEIPT</h1>
<?php
  $purchase_result = mysqli_query($conn,"select *from payments where payment_id='$_GET[order_id]'");
  $fetch_payment=mysqli_fetch_array($purchase_result);

    $select_product = mysqli_query($conn,"select *from products where productID = '$fetch_payment[product_id]'");
    $fetch_product = mysqli_fetch_array($select_product);

    $select_buyer = mysqli_query($conn,"select *from users where id='$fetch_payment[buyer_id]'");

    $fetch_buyer = mysqli_fetch_array($select_buyer);
  ?>
<div class="col-md-8 card" style="background:#101010">
    <div class="card-body">
    <div class="text-center pt-2 mt-2" style="background:black;">
            <span class="navbar-brand" style="color:#44d62c;">
                <h6 class="h6-responsive">
                <span class="font-weight-bold" style='color:#44d62c'>PURCHASE</span>
                <span class="text-white">RECEIPT</span>
                </h6>
            </span>
    </div>
    <div>
        <h2 style="color:grey;padding:10px">Invoice : #<?php echo $fetch_payment['invoice_id'];?><span style="font-size:15px;"> Date : <?php echo $fetch_payment['date'];?></span><hr style="background:lightgrey"></h2>
        
    </div>
    <div  style="color:lightgrey;background:#101010;padding:10px;font-size:14px">
      <i>
      <span  scope="col">ITEM :
        <a href="details.php?productID=<?php echo $fetch_product['productID'];?>"><?php echo $fetch_product['product_title'];?></a>
      </span><br/>
      <span  scope="col">TRANSACTION ID : <?php echo $fetch_payment['tx_id'];?></span><br/>
      <span  scope="col">ORDERED : <?php echo $fetch_product['product_title'];?></span><br/>
      <span  scope="col">QUANTITY : <?php echo $fetch_payment['quantity']?></span><br/>
      <span  scope="col">PRICE : <?php echo $fetch_product['product_price']?></span><br/>
      <span  scope="col">SUB TOTAL : $cad <?php echo $fetch_payment['amount'];?></span><br/>
      </i>
    </div>
    
    <div class="row p-2">
        <div class="col-md-6">
            <p style="color: yellow">Sold To</p>
            <span style="color:white">Name : <?php echo $fetch_buyer['username'];?></span><br>
            <span style="color:white">EMAIL: <?php echo $fetch_payment['payer_email'];?></span><br>
            <span style="color:white">Address : <?php echo $fetch_buyer['user_address'];?></span><br>
            <span style="color:white"><?php echo $fetch_buyer['user_country'];?></span>
        </div>
        <div class="col-md-6">
            <p style="color: yellow;">Pay To</p>
            <span style="color:white">WEBSITE : DARKSTREET</span><br/>
            <span style="color:white">PAYMENT METHOD : <?php echo $fetch_payment['payment_type'];?></span>
        </div>
    </div>

   
</div>
</div>