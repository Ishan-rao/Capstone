<?php

    session_start();
    include "./functions/functions.php";
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
    <style>
    body{
    background:#424242;
    }
    nav{
        background:black;
        border:1px solid black;

    }
    .card-item{
        background:black;
        color:white;
         
    }
    .navbar-nav li a{
        color:lightgrey;
        font-size:12px;
        font-family:arial;
    }
    .header-intro-image{
    background:#090909;
    }
    .header-form{

        margin-left:40%;
    }
    .dropdown-menu{
    background:black;
    color:green;
    }
    .dropdown-item:hover{
    background:black;
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
    .item-banner{
    background:#151515;
   
    
    }
    .content-intro{
    background:#101010;
    padding-bottom:100px;
    }
    .banner{
    background-image: url("images/kishi-homepage-large.jpg"); 
    background-color: #cccccc;
    height: 500px; 
    background-position: center;
    background-repeat: no-repeat; 
    background-size: cover; 

    }
    .navbar-dark{
      margin-top:40px;
    }
    </style>

<body>

<!-- navigation bar starts -->
<nav class="navbar fixed-top" style="background:#101010">
<div class="container">
<span style="margin-left:800px"></span>
<?php if (!isset($_SESSION['user_id'])) { ?>
 <span>
  <a href="index.php?action=login" class="ml-1 login-css" style="font-size:.8em;">LOGIN</a> <span class="text-white"> /</span>
  <a href="register.php" class="ml-1 login-css" style="font-size:.8em;">REGISTER</a>
  <!-- <span><i class="fas fa-sign-in-alt"></i></span> -->
  <!-- <span><i class="far fa-user-circle"></i></span> -->
  </span>
<?php }else { ?>

  <?php
        $select_user = mysqli_query($conn,"select *from users where id='$_SESSION[user_id]'");    
        $data_user = mysqli_fetch_array($select_user); 
      ?>
        <!-- Basic dropdown -->
        <div class="dropdown">
          <a class=" dropdown-toggle" style="color:white" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <?php if($data_user['user_image'] !=''){?> 

          <span style="font-size:.8em;">
            <img src="./customer/customer_images/<?php echo $data_user['user_image'];?>" style="border-radius:100%;" class="img-responsive" height="20px" width="20px" alt="">
             USER PROFILE
          </span> 
         
         <?php }else{ ?>
          <span style="font-size:.8em;">
            <img src="./images/placeholder-profile.jpg" style="border-radius:100%;" class="img-responsive" height="20px" width="20px" alt=""> 
            USER PROFILE            
            </span> 
         
         <?php } ?>
          
          
          </a>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="myaccount.php?action=edit_account" style="color:#44d62c;font-size:.7em">ACCOUNT SETTING</a>
            <a class="dropdown-item" href="myaccount.php?action=purchase_history" style="color:#44d62c;font-size:.7em">PURCHASE HISTORY</a>
            <a class="dropdown-item" href="logout.php" style="color:#44d62c;font-size:.7em">LOGOUT</a>
          </div>
        </div>
          <!-- Basic dropdown -->

 <?php } ?>
 <!-- cart and search bar  -->
<span>
<span style="color:white;padding:10px;background:black;margin-right:10px;">
 <i class="fas fa-shopping-cart mr-2" id='item-cart' style="color:lightgrey">&nbsp;
  <a href="cart.php"><?php 
   total_items_cart();
  ?></a>
  </span></i>
  <a href="search_result.php"><i class="fas fa-search" style='color: #44d62c'></i></a>
</span>
<!-- cart and search bar  ends-->
</div>
</nav>

<nav class="navbar navbar-dark">
<div class="container ">
  <a class="navbar-brand" href="index.php" style="font-family: 'Holtwood One SC', serif; color: #44d62c">
   <span><img src="./images/logo3.PNG" class="fluid-img" height='50em' width='45em' style="border-radius:100%" alt="logo"></span> 
   <i class="text-logo">DARK STREET</i>&nbsp;<i class="fas fa-road" style="color:white"></i>
  </a> 

</div>
</nav>

<nav class="navbar navbar-expand-lg">
<div class="container">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon text-light" style="color:white"><i class="fas fa-bars"></i></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">HOME</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="all_products.php">ALL PRODUCTS</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="cart.php">SHOPPING CART</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="contactus.php">CONTACT US</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">SUPPORT</a>
      </li>
    </ul>
  </div>
  </div>
</nav>
<!-- navigation bar ends  -->
