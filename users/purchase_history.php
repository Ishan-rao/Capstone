<style>
   
</style>
<div class="col-md-8 card" style="background:#101010">
    <div class="card-body">
    <div class="text-center pt-2 mt-2" style="background:black;">
            <span class="navbar-brand" style="color:#44d62c;">
                <h6 class="h6-responsive">
                <span class="font-weight-bold" style='color:#44d62c'>PURCHASE</span>
                <span class="text-white">HISTORY</span>
                </h6>
            </span>
    </div>
<table class="table table-borderless" style="background:#101010">
  <thead>
    <tr  style="color:#44d62c;">
      
      <th class="font-weight-bold" scope="col">INVOICE ID</th>
      <th class="font-weight-bold" scope="col">DATE</th>
      <th class="font-weight-bold" scope="col">IMAGE</th>
      <th class="font-weight-bold" scope="col">TOTAL PRICE</th>
      <th class="font-weight-bold" scope="col">PAYMENT TYPE</th>
      <th class="font-weight-bold" scope="col">STATUS</th>
      <th class="font-weight-bold" scope="col">RECIEPT</th>
    </tr>
  </thead>
  <?php
  $purchase_result = mysqli_query($conn,"select *from payments where buyer_id='$_SESSION[user_id]'");
  while($fetch_payment=mysqli_fetch_array($purchase_result)){

    $select_product = mysqli_query($conn,"select *from products where productID = '$fetch_payment[product_id]'");
    $fetch_product = mysqli_fetch_array($select_product);
  ?>
  <tbody style="color:lightgrey">
    <tr>
    <td><?php echo $fetch_payment['invoice_id'];?></td>
        <td><?php echo $fetch_payment['date'];?></td>
        <td><img src="admin_area/product_images/<?php echo $fetch_product['product_image']?>" height="30px" width="70px" alt=""></td>
        <td><?php echo $fetch_payment['amount'];?></td>
        <td><i style="color:yellow"><?php echo $fetch_payment['payment_type'];?></i></td>
        <td><?php echo $fetch_payment['payment_status'];?></td>
        <td><a class="text-primary" href="myaccount.php?action=view_receipt&order_id=<?php echo $fetch_payment['payment_id']?>">Receipt</a></td>
    </tr>
  </tbody>
<?php } ?>
</table>
</div>
</div>