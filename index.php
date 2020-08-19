<?php

    include "./includes/navigation.php";
?>
<!-- add to cart -->
<?php
addToCart();
?>
<?php
  if(!isset($_GET['action'])){
?>
<!-- banner -->
<div class="wow fadeIn">
<div class="container-fluid banner">
  <div class="row">
  <div class="col-3"></div>
  <div class="col-6 text-center">
   <a href="#"> 
    <h2 class="text-white h3-responsive text-center mt-5">MAKE YOUR MOVE </h2>
    <span class="text-white" style="font-family: 'Titillium Web', sans-serif;font-weight:bold">SHOP NOW &nbsp;
    <i class="fas fa-angle-right" style="color:#44d62c"></i>
    </span>
   </a>
  </div>
  <div class="col-3"></div>
  </div> 
</div>
<!-- banner ends -->
<!-- content start -->
<div class="fluid-container">
    <div class="card mt-2 content-intro">
        <div class="card-body">
        <p class="text-center text-white pt-5" style="font-size:17px">WHY BUY FROM DARKSTREET ?</p>
        <div class="row text-center" style="margin-top:100px">
        
            <div class="col-md-4">
                <i class="fab fa-product-hunt" style="color:#44d62c;font-size:30px"></i><h5 class="text-light p-3">Best Products</h5> 
                <p style="color:grey">Make it interesting and fun, especially if you have a less-than-riveting product</p>
            </div>
            <div class="col-md-4">
                <i class="fas fa-shipping-fast" style="color:#44d62c;font-size:30px"></i><h5 class="text-light p-3">Free & Fast Shipping</h5>
                <p style="color:grey">Items that can be delivered within 4 days for free, and that protects both buyers and sellers should an item arrive late.</p>
            </div>
            <div class="col-md-4">
                <i class="fas fa-sync" style="color:#44d62c;font-size:30px"></i><h5 class="text-light p-3">100% Money Back</h5>
                <p style="color:grey"> If a buyer is not satisfied with a product or service, a refund will be made.</p>
            </div>
        </div>
        </div>
    </div>
</div>
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
<!-- solution page here -->
<!-- product-display ends -->
<!--main content ends-->
<div class="fluid-container" style="background:black">
  <h2 class="text-center p-4 h2-responsive">
    <span class="font-weight-bold" style='color:#44d62c'>FEATURED</span>
    <span class="text-white"> PRODUCTS</span>
  </h2>
</div>

<?php
 $product_list = "SELECT *FROM products order by RAND() LIMIT 0,6";
        
 $product_list_Datalist = mysqli_query($conn,$product_list);

 echo "<div class='container-fluid item-banner' style='margin-top:-8px'> 
         <div class='row'>";
 while($product_list_Data = mysqli_fetch_array($product_list_Datalist)){

           $productID = $product_list_Data['productID'];
           $productcategory = $product_list_Data['product_category'];
           $productBrand = $product_list_Data['product_brand'];
           $productTitle = $product_list_Data['product_title'];
           $productPrice = $product_list_Data['product_price'];
           $productIMG = $product_list_Data['product_image'];
           $productDesc = $product_list_Data['product_desc'];
           echo "
                    <div class='col-md-4 p-1 m-0'>
                     <div class='card card-item'>
                     <img class='card-img-top' src='./admin_area/product_images/$productIMG' height='300em' alt='Card image cap'>
                     <div class='card-body'>
                         <h5 class='card-title' style='color:#44d62c;font-family: 'Titillium Web', sans-serif;'>$productTitle</h5>
                         <p class='pt-2 text-white' style='font-size:15px;font-family:sans-serif;'>$productDesc</p>
                         <a href='details.php?productID=$productID' class='text-white'><i class='fas fa-info-circle'></i> BUY NOW</a>
                         <p class='p-2' style='background:black'><span style='font-size:1em;color:white;'>Price : </span><span style='color:#44d62c'> $productPrice</span></p>
                          
                     </div>
                     </div>
                     <br/>
                     </div>
                   
           ";
         
               
           
 }
 echo "</div></div>";
 
?>
<?php }else{?>
<?php include 'login.php';?>
<?php }; ?>

<!-- footer start  -->
<div class="fluid-container">
<?php include './includes/footer.php';?>
</div>

<!-- footer ends -->
