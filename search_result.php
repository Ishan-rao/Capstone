<?php

  include './includes/database.php';

?>
<!doctype html>
<html lang="en">
  <head>
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
<!-- Bootstrap core CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
<!-- Material Design Bootstrap -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.0/css/mdb.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Holtwood+One+SC&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.0/animate.css">
<style>
body{
   background:#424242;
  
}
nav{
    background:black;
    border:1px solid black;

}
form{
  color:white;
}
.login-css{
    color:lightgrey;
    }
    .login-css:hover{
    color:#44d62c;
    }
    ::-webkit-scrollbar{
    width:12px;
    }
    ::-webkit-scrollbar-thumb{
    background:linear-gradient(transparent,#30ff00);
    border-radius:6px;

    }
    ::-webkit-scrollbar-thumb:hover{
    background:linear-gradient(transparent,black);
    }
</style>
<div>
<nav class="navbar navbar-dark">
<div class="container ">
  <a class="navbar-brand" href="index.php" style="font-family: 'Holtwood One SC', serif; color: #44d62c">
   DARK STREET 
  </a> 
  <a href="index.php"><i class="fas fa-times" style="font-size:1.5em;color: #44d62c"></i></a>
</div>
</nav>
<div class="container-fluid mt-1 p-2 bg-dark">
<!-- Search form -->
<div class="container">
<form action='search_result.php' method='GET' enctype='multipart/form-data' class="form-inline d-flex justify-content-center md-form form-sm  mt-2" autocomplete="off">
  <input  class="form-control  form-control-sm mr-3 w-75" type="text" style="color:#44d62c;" placeholder="SEARCH YOUR PRODUCT..." name='search_product'>
    <button class="p-1" style="color:#44d62c;background:#212121;outline:none;border:#212121" name="search" type="submit"><i class="fas fa-search"></i></button>
</form>

</div>
</div>
<div class="container">
<?php

  
if (isset($_GET['search'])) {

    $search_product = $_GET['search_product'];
    $run_query_by_productID = mysqli_query($conn,"select *from products where product_keywords like '%$search_product%' ");
   
    echo "<div class='container-fluid item-banner mt-2'> 

    <div class='container-fluid'>
    <h2 class='text-center pt-4 h2-responsive'>
        <span class='font-weight-bold' style='color:#44d62c'>YOUR SEARCHED</span>
        <span class='text-white'> PRODUCTS</span>
      </h2>
    
    </div>
      <div class='row pt-3'>";
    while($product_single = mysqli_fetch_array($run_query_by_productID)){

        $productTitle = $product_single['product_title'];
        $productPrice = $product_single['product_price'];
        $productIMG = $product_single['product_image'];
        $productDesc = $product_single['product_desc'];
        $product_id = $product_single['productID'];

        echo "
        <div class='col-md-3 p-1 m-0'>
         <div class='card card-item'>
         <img class='card-img-top' src='./admin_area/product_images/$productIMG' height='150em' alt='Card image cap'>
         <div class='card-body' style='background:#212121;height:250px'>
             <p class='card-title' style='color:#44d62c;font-weight:bold'>$productTitle</p>
             <p class='card-title' style='color:lightgrey;font-family:arial'>$productDesc</p>
         </div>
         
         </div>
         <p class='p-2' style='background:black'><span style='font-size:1em;color:white;'>Price : </span><span style='color:#44d62c'> $productPrice</span>
          <a href='details.php?productID=$product_id' class='text-white float-right'><i class='fas fa-info-circle'></i> BUY NOW</a></p>

         <br/>
         </div>
       ";
       
    }
    echo "</div></div>";

}

?>
</div>
</div>
</div>
<br/><br/>
<?php
include './includes/footer.php';
?>