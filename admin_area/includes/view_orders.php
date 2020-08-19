<h1>Customer Order<hr></h1>
<style>
   
</style>
<table class="table table-borderless">
  <thead>
    <tr  style="color:#101010">
      
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
  $purchase_result = mysqli_query($conn,"select *from payments order by payment_id DESC");
  while($fetch_payment=mysqli_fetch_array($purchase_result)){

    $select_product = mysqli_query($conn,"select *from products where productID = '$fetch_payment[product_id]'");
    $fetch_product = mysqli_fetch_array($select_product);
  ?>
  <tbody>
    <tr>
    <td><?php echo $fetch_payment['invoice_id'];?></td>
        <td><?php echo $fetch_payment['date'];?></td>
        <td><img src="product_images/<?php echo $fetch_product['product_image']?>" height="30px" width="70px" alt=""></td>
        <td><?php echo $fetch_payment['amount'];?></td>
        <td><i class="text-primary"><?php echo $fetch_payment['payment_type'];?></i></td>
        <td><?php echo $fetch_payment['payment_status'];?></td>
        <td><a class="text-primary" href="index.php?action=view_receipt&order_id=<?php echo $fetch_payment['payment_id']?>">Receipt</a></td>
    </tr>
  </tbody>
<?php } ?>
</table>
</div>
</div>