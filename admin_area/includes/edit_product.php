<?php
    include '../includes/database.php';

    if (isset($_POST['edit_product'])) {

        $product_title = trim(mysqli_real_escape_string($conn,$_POST['product-title']));
        $product_category = $_POST['product-category'];
        $product_brand = $_POST['brand-category'];
        $product_price = $_POST['product-price'];
        $product_desc = trim(mysqli_real_escape_string($conn,$_POST['product-desc']));
        $product_keywords = $_POST['product-keywords'];
     
        $product_image_tmp = $_FILES['product-image']['tmp_name'];
        $product_image = $_FILES['product-image']['name'];
        
        $date = date("F,d,Y");
        
        if(!empty($_FILES['product_image']['name'])){

            if(move_uploaded_file($product_image_tmp,'product_images/'.$_FILES['product-image']['name'])){
               
                $update_product = mysqli_query($conn,"update products set product_category='$product_category',product_brand='$product_brand', product_title='$product_title',product_price='$product_price',product_desc='$product_desc',product_image='$product_image',product_keywords='$product_keywords',date='$date' where productID='$_GET[product_id]'");
            }
        }else{
            $update_product = mysqli_query($conn,"update products set product_category='$product_category',product_brand='$product_brand', product_title='$product_title',product_price='$product_price',product_desc='$product_desc',product_keywords='$product_keywords',date='$date' where productID='$_GET[product_id]'");
        }
        
        if($update_product){
        echo "<script>alert('Product updated successfully!!')</script>";
        echo "<script>window.open(window.location.href,'_self')</script>";
        }
    
       
    }
?>
<!-- updating product -->
<?php
    $edit_product = mysqli_query($conn,"select *from products where productID='$_GET[product_id]'");
    $fetch_edit = mysqli_fetch_array($edit_product);
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
                    <h2 class="text-center p-2">Edit Product<hr></h2>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- Product id -->
                                    <label for="product-title">PRODUCT TITLE</label>
                                    <input type="text" class="form-control" value="<?php echo $fetch_edit['product_title']; ?>" name="product-title" required/>
                                </div>
                                <div class="col-md-6">
                                    <!-- Product-category -->
                                <label for="product-category">PRODUCT CATEGORY</label>
                                <select id="product-category" name ="product-category" class="form-control">
                                    <option selected>Choose...</option>
                                    <?php
                                    $get_category = "SELECT *FROM categories";
                                    $category_data = mysqli_query($conn,$get_category);

                                    while($category_data_rows=mysqli_fetch_array($category_data)){

                                        $categoryID = $category_data_rows['categoryID'];
                                        $categoryTITLE = $category_data_rows['categoryTitle'];
                                        
                                        if($fetch_edit['product_category']== $categoryID){
                                            echo "<option value = '$fetch_edit[product_category]' selected>".$categoryTITLE."</option>";
                                        }else{
                                             echo "<option value = $categoryID>".$categoryTITLE."</option>";
                                    }
                                }
                                ?>
                                </select>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                       <!-- Brand-category -->
                                    <label for="brand-category">PRODUCT BRAND</label>
                                    <select id="brand-category" name="brand-category" class="form-control">
                                        <option selected>Choose...</option>
                                        <?php
                                        $get_brand = "SELECT *FROM brands";
                                        $brand_data = mysqli_query($conn,$get_brand);
                                
                                        while($brand_data_rows=mysqli_fetch_array($brand_data)){
                                
                                            $brandID = $brand_data_rows['brandID'];
                                            $brandTITLE = $brand_data_rows['brandTitle'];
                                            
                                            if($fetch_edit['product_brand']==$brandID){
                                             echo "<option value = $fetch_edit[product_brand] selected>".$brandTITLE."</option>";
                                            }else{
                                            echo "<option value = $brandID>".$brandTITLE."</option>";
                                        }
                                    }
                                    ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <!-- Product image -->
                                    <label for="product-image">PRODUCT IMAGE</label>
                                    <div class="custom-file">
                                        <input type="file" name="product-image" class="custom-file-input" >
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                    <img class="p-2" src="product_images/<?php echo $fetch_edit['product_image']?>" height="80px" width="100px" alt="">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <!-- Product price -->
                                    <label for="product-price">PRODUCT PRICE</label>
                                    <input type="text" value="<?php echo $fetch_edit['product_price'];?>" class="form-control" name="product-price" required/>
                                </div>
                                <div class="col-md-6">
                                    <!-- Product keywords -->
                                    <label for="product-keywords">PRODUCT KEYWORDS</label>
                                    <input type="text" value="<?php echo $fetch_edit['product_keywords'];?>" class="form-control" name="product-keywords" required/>
                                    <br/>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <!-- Product description -->
                                    <label for="product-description">PRODUCT DESCRIPTION</label>
                                    <textarea class="form-control"  name="product-desc" required><?php echo $fetch_edit['product_desc'];?></textarea>
                                </div>
                            </div>
                            <button type="submit" name="edit_product" class="btn btn-success btn-md btn-sm font-weight-bold mt-3">SAVE CHANGES</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
    </html>