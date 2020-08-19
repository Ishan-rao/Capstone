<?php
include './includes/navigation.php';
?>

<?php
if(!isset($_SESSION['user_id'])){

        include 'login.php';

}else{
?>

<div class="container" style="background:#101010">
    <div class="row">
        <div class="col-md-7 card p-3" style="background:#101010">
            <h3 class="text-white">Checkout :<span class="float-right"> Your Items (<?php echo total_items_cart();?>)</span><hr style="background:#212121"></h3>
        
            <?php
            $checkout_ip = get_ip();
            $select_cart = mysqli_query($conn,"select *from cart where ip_address='$checkout_ip'");
            while($fetch_cart = mysqli_fetch_array($select_cart)){

                $select_product = mysqli_query($conn,"select *from products where productID = '$fetch_cart[product_id]'");
                while($fetch_product = mysqli_fetch_array($select_product)){

                  ?>
                  <div class="row p-2">
                      <div class="col-md-2"><img src="admin_area/product_images/<?php echo $fetch_product['product_image'];?>" height="70px" width="100px" alt=""></div>
                      <div class="col-md-3">
                          <span style="color:lightgrey;font-size:13px"><?php echo $fetch_product['product_title'];?></span><br/>
                          <span style="color:grey;font-size:13px">Quantity :<?php echo $fetch_cart['quantity'];?></span><br>
                          <span style="color:grey;font-size:13px">Price : cad$ <?php echo ($fetch_product['product_price']*$fetch_cart['quantity']);;?></span>
                      </div>
                  </div>
                  <?php }} ?>
        </div>





        <div class="col-md-5">
            <div style="background:#101010;padding:20px;">
            <h3 class="text-white ">Total Price : cad$ <span style="color:#44d62c"> <?php echo total_price();?></span></h3>
            <?php include 'payment.php';?>
            </div>
        </div>
    </div>
</div>

<?php } ?>

<?php include './includes/footer.php'; ?>