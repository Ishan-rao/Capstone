<?php
    include '../includes/database.php';

    if (isset($_POST['insert-brand'])) {

       $product_brand = mysqli_real_escape_string($conn,$_POST['product-brand']);
       
       $insert_brand = mysqli_query($conn,"insert into brands(brandTitle)values('$product_brand')");
       if($insert_brand){

        echo "<script>alert('Product Brand has been inserted successfully')</script>";
        echo "<script>window.open(window.location.href,'_self')</script>";
    }
    }
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
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.0/css/mdb.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Holtwood+One+SC&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.0/animate.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Dark Street</title> 
    </head>
    <body>
        
        <div class="container">
            <div class="fluid-container">
                <div class="">
                    <div class="card-body">
                    <h1 class="text-center p-2">Add Brand<hr></h1>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- Product id -->
                                    <label for="product-cat">ADD NEW BRAND</label>
                                    <input type="text" class="form-control" name="product-brand" required/>
                                </div>
                                <div class="col-md-6">
      
                                </div>
                            </div>                      
                            <button type="submit" name="insert-brand" class="btn btn-success  btn-sm font-weight-bold mt-3">ADD BRAND</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
    </html>