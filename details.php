<?php

    include "./includes/navigation.php";
?>
<style>
body{
  background-image: url("./images/register5.png");
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: 100% 100%;
}
</style>
<?php
    if(isset($_GET['add_cart'])){

      $product_id = $_GET['add_cart'];
      $ip_address = get_ip();

      $run_check_pro = mysqli_query($conn,"select *from cart where product_id='$product_id'");
      if(mysqli_num_rows($run_check_pro)>0){

          echo "";
      }else{

          $fetch_pro = mysqli_query($conn,"select *from products where productID = '$product_id'");
          $fetch_pro = mysqli_fetch_array($fetch_pro);
          $pro_title = $fetch_pro['product_title'];
          $run_insert_pro=mysqli_query($conn,"insert into cart(product_id,product_title,ip_address)values('$product_id','$pro_title','$ip_address')");

          echo "<script>window.open('details.php?productID=$product_id','_self')</script>";
          
         
      }
  }
?>


<!-- product display -->
<div class="container">
<div class="container text-left pt-2 mt-2" style="background:black;">
 <span class="navbar-brand" style="color:#44d62c;">
    <h6 class="h6-responsive">
      <span class="font-weight-bold" style='color:#44d62c'>PRODUCT</span>
      <span class="text-white"> DETAILS</span>
    </h6>
  </span>
</div>

<?php
if (isset($_GET['productID'])) {
    
    $productid = $_GET['productID'];

    $run_query_by_productID = mysqli_query($conn,"select *from products where productID ='$productid'");
  
    while($product_single = mysqli_fetch_array($run_query_by_productID)){

        $productTitle = $product_single['product_title'];
        $productPrice = $product_single['product_price'];
        $productIMG = $product_single['product_image'];
        $productDesc = $product_single['product_desc'];
        $product_id = $product_single['productID'];

        echo "
        
                <div class='container-fluid pt-2' style='background:black'>
                    <div class ='row'>
                        <div class='col-md-4'>
                        <img class='img-fluid' src='./admin_area/product_images/$productIMG' style='height:200px'>
                        </div>
                        <div class='col-md-8 pt-2 p-3' style='background:black'>
                            <h2 style='color:#44d62c;'>$productTitle</h2>
                            <p>
                                <span style='font-size:1em;color:white;'>Price :</span> 
                                <span style='font-weight:bold;color:#44d62c;'>$ $productPrice</span>
                            </p>
                            <h4 style='color:lightgrey;'>Description</h4>
                           
                            <p style='color:white;'>$productDesc</p>
                            <p></p>
                            <p></p> 
                            <a href='details.php?add_cart=$product_id'>
                            <p><button class='btn btn-dark' ><i class='fas fa-cart-arrow-down'></i> ADD TO CART</button></p>   
                            </a>  
                        </div>
                    </div>
                </div>
        ";
    }
}
?>
</div>
<!-- product-display ends -->
<!--main content ends-->
<br/>
<!-- footer start  -->
<div class="fluid-container">
<?php include './includes/footer.php';?>
</div>

<!-- footer ends -->
