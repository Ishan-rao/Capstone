<?php

    include "./includes/navigation.php";
?>
<!-- content ends -->
<!-- main content starts -->
<!-- <div class="container-fluid item-banner">
<div class="fluid-container pt-5">
  <h2 class="text-center p-4 h2-responsive">
    <span class="font-weight-bold" style='color:#44d62c'>PRODUCT</span>
    <span class="text-white"> EXPLORE</span>
    <p><i class="fas fa-chevron-down text-white"></i></p>
  </h2>
</div> -->
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

          echo "<script>window.open('all_products.php','_self')</script>";
          
         
      }
  }
?>
<style>
body{
  background-image: url("./images/register5.png");
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: 100% 100%;
}
.flt-lft{
   float : left;
}
</style>
<div class="fluid-container mt-2">
<nav class="container navbar navbar-expand-lg">
  <span class="navbar-brand" style="color:#44d62c">
  <h5 class="h5-responsive">
    <span class="font-weight-bold" style='color:#44d62c'>PRODUCT</span>
    <span class="text-white"> EXPLORE</span>
  </h5>
  </span>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon" style="color:white"><i class="fas fa-filter"></i></span>
  </button>
  <span style="margin-left:650px"></span>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <span class="font-weight-bold" style="font-size:16px">Categories</span> 
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
        <?php
         fetch_categories();
        ?>
        </div>
        
      </li>
    </ul>
    <ul class="navbar-nav">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="font-weight-bold" style="font-size:16px">Brands</span> 
        </a>
        <div class="dropdown-menu text-white" aria-labelledby="navbarDropdownMenuLink">
          <?php
           fetch_brands();
        ?>
        </div>
      </li>
    </ul>
  </div>
</nav>
</div>
<!-- product display -->
<div class="fluid-container">
<?php
all_productsBy();
?>
<?php
getProductByCategory();
?>
<!-- brand selection -->
<?php
getProductByBrand();
?>

</div>
<!-- product-display ends -->
<!--main content ends-->

<!-- footer start  -->
<div class="fluid-container">
<?php include './includes/footer.php';?>
</div>

<!-- footer ends -->
