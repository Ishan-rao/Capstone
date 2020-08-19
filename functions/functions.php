<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbName = "darkstreet";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password,$dbName);
    
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    // echo "Connected successfully";

    function fetch_categories(){
        global $conn;
        $fetch_categories = "select *from categories";
        $run_query = mysqli_query($conn,$fetch_categories);

        while ($rows_categories=mysqli_fetch_array($run_query)) {
            $categories_ID = $rows_categories["categoryID"];
            $categories_Title = $rows_categories["categoryTitle"];

            echo "<a class='dropdown-item text-white' href='all_products.php?categoryID=$categories_ID'>$categories_Title</a>";
        }
    }

    function fetch_brands(){
        global $conn;
        $fetch_brands = "select *from brands";
        $run_query = mysqli_query($conn,$fetch_brands);

        while ($rows_brand=mysqli_fetch_array($run_query)) {
            $brands_ID = $rows_brand["brandID"];
            $brands_Title = $rows_brand["brandTitle"];

            echo "<a class='dropdown-item text-white' href='all_products.php?brandID=$brands_ID'>$brands_Title</a>";
        }
    }

    function fetch_product(){
        if(!isset($_GET['categoryID'])){
            if(!isset($_GET['brandID'])){
                global $conn;
          $product_list = "SELECT *FROM products order by RAND() LIMIT 0,3";
        
          $product_list_Datalist = mysqli_query($conn,$product_list);
        
          echo "<div class='container-fluid item-banner'> 
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
                                  <a href='details.php?productID=$productID' class='text-white'><i class='fas fa-info-circle'></i> Details</a>
                                 
        
                              </div>
                              </div>
                              <br/>
                              </div>
                            
                    ";
                  //   <a href='index.php?add_cart=$productID'>
                  //   <p class='pt-2'><button class='btn btn-dark' ><i class='fas fa-cart-arrow-down'></i> ADD TO CART</button></p>
                  // </a>
                        
                    
          }
          echo "</div></div>";
        }
        }
        
    }

    function all_productsBy(){
            if(!isset($_GET['categoryID'])){
                if(!isset($_GET['brandID'])){
                    global $conn;
              $product_list = "SELECT *FROM products";
            
              $product_list_Datalist = mysqli_query($conn,$product_list);
            
              echo "<div class='container item-banner'> 
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
                                  <div class='card card-item' style='height:550px'>
                                  <img class='card-img-top' src='./admin_area/product_images/$productIMG' height='250px' alt='Card image cap'>
                                  <div class='card-body'>
                                      <h5 class='card-title' style='color:#44d62c;font-family: 'Titillium Web', sans-serif;'>$productTitle</h5>
                                      <p class='pt-2 text-white' style='font-size:15px;font-family:sans-serif;'>$productDesc</p>
                                      
                                                 
                                  </div>
                                  <div class='p-3'>
                                  <a href='details.php?productID=$productID' class='text-white p-2'><i class='fas fa-info-circle'></i> Details</a>
                                  <a href='all_products.php?add_cart=$productID'>
                                  <p><button class='btn btn-dark' ><i class='fas fa-cart-arrow-down'></i> ADD TO CART</button></p>   
                                  </a>
                                  </div>                                 
                                  </div>                                  
                                  <br/>
                                  </div>
                                
                        ";
                        
                            
                        
              }
              echo "</div></div>";
            }
            }
            
        }
    
    
    function getProductByCategory(){

        if (isset($_GET['categoryID'])) {
            global $conn;
            $categoryID = $_GET['categoryID'];
            $get_cat_product = "select *from products where product_category=$categoryID";
            $run_cat_product = mysqli_query($conn,$get_cat_product);
        
            $cat_count = mysqli_num_rows($run_cat_product);
            if($cat_count == 0 ){
        
                // echo "<h2 style='color:white;padding:20px;text-align:center'>No Product found.</h2>";
        
                echo "<div class='container'><img src='./images/noproduct.jpg' class='fluid-image ml-auto' style='border-radius:10px;'></div>";
            }
        
            echo "<div class='container item-banner'> 
            <div class='row'>";
            while($row_cat_pro = mysqli_fetch_array($run_cat_product)){
        
                $pro_id = $row_cat_pro['productID'];
                $pro_cat = $row_cat_pro['product_category'];
                $pro_brand = $row_cat_pro['product_brand'];
                $pro_Title = $row_cat_pro['product_title'];
                $pro_Price = $row_cat_pro['product_price'];
                $pro_IMG = $row_cat_pro['product_image'];
                $pro_Desc = $row_cat_pro['product_desc'];
                echo "
                <div class='col-md-4 p-1 m-0'>
                 <div class='card card-item' style='height:600px'>
                 <img class='card-img-top' src='./admin_area/product_images/$pro_IMG' height='300em' alt='Card image cap'>
                 <div class='card-body'>
                     <h5 class='card-title' style='color:#44d62c;font-family: 'Titillium Web', sans-serif;'>$pro_Title</h5>
                     <p class='pt-2 text-white' style='font-size:15px;font-family:sans-serif;'>$pro_Desc</p>
                      
        
                 </div>
                 <div style='padding:10px'>
                 <a href='details.php?productID=$pro_id' class='text-white'><i class='fas fa-info-circle'></i> Details</a>
                     <a href='all_products.php?add_cart=$pro_id'>
                        <p><button class='btn btn-dark' ><i class='fas fa-cart-arrow-down'></i> ADD TO CART</button></p>   
                    </a>
                    </div>
                 </div>
                 
                 <br/>
                 </div>
               
        ";
                
            }
            echo "</div></div>";
        }
        
    }

    function getProductByBrand(){

        if (isset($_GET['brandID'])) {
            global $conn;
            $brandID = $_GET['brandID'];
            $get_brand_product = "select *from products where product_brand=$brandID";
            $run_brand_product = mysqli_query($conn,$get_brand_product);
        
            $brand_count = mysqli_num_rows($run_brand_product);
            if($brand_count == 0 ){
        
                // echo "<h2 style='color:white;padding:20px;text-align:center'>No Product found.</h2>";
        
                echo "<div class='container'><img src='./images/noproduct.jpg' class='fluid-image' style='border-radius:10px;'></div>";
            }
        
            echo "<div class='container item-banner'> 
            <div class='row'>";
            while($row_brand_pro = mysqli_fetch_array($run_brand_product)){
        
                $pro_id = $row_brand_pro['productID'];
                $pro_cat = $row_brand_pro['product_category'];
                $pro_brand = $row_brand_pro['product_brand'];
                $pro_Title = $row_brand_pro['product_title'];
                $pro_Price = $row_brand_pro['product_price'];
                $pro_IMG = $row_brand_pro['product_image'];
                $pro_Desc = $row_brand_pro['product_desc'];
                echo "
                <div class='col-md-4 p-1 m-0'>
                 <div class='card card-item'>
                 <img class='card-img-top' src='./admin_area/product_images/$pro_IMG' height='300em' alt='Card image cap'>
                 <div class='card-body' style='600px'>
                     <h5 class='card-title' style='color:#44d62c;font-family: 'Titillium Web', sans-serif;'>$pro_Title</h5>
                     <p class='pt-2 text-white' style='font-size:15px;font-family:sans-serif;'>$pro_Desc</p>
                     <a href='details.php?productID=$pro_id' class='text-white'><i class='fas fa-info-circle'></i> Details</a>
                     <a href='all_products.php?add_cart=$pro_id'>
                        <p><button class='btn btn-dark' ><i class='fas fa-cart-arrow-down'></i> ADD TO CART</button></p>   
                     </a> 
        
                 </div>
                 </div>
                 <br/>
                 </div>
               
        ";
                
            }
            echo "</div></div>";
        }
        
    }

    //ip_address

function get_ip(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function addToCart(){

    global $conn;
    if(isset($_GET['add_cart'])){

        $product_id = $_GET['add_cart'];
        $ip_address = get_ip();

        $run_check_pro = mysqli_query($conn,"select *from cart where product_id='$product_id' and ip_address='$ip_address'");
        if(mysqli_num_rows($run_check_pro)>0){

            echo "";
        }else{

            $fetch_pro = mysqli_query($conn,"select *from products where productID = '$product_id'");
            $fetch_pro = mysqli_fetch_array($fetch_pro);
            $pro_title = $fetch_pro['product_title'];
            
            $run_insert_pro=mysqli_query($conn,"insert into cart(product_id,product_title,ip_address,)values('$product_id','$pro_title','$ip_address')");
                
            echo "<script>window.open('index.php','_self')</script>";
            
           
        }
    }
}
function total_items_cart(){
    global $conn;
    $ip_address = get_ip();
    $run_item = mysqli_query($conn,"select *from cart where ip_address='$ip_address'");

    echo $count_items = mysqli_num_rows($run_item);
}

function total_price(){

    global $conn;
    $total=0;
    $ip = get_ip();

    $run_cart = mysqli_query($conn,"select *from cart where ip_address='$ip'");
    while ($fetch_cart = mysqli_fetch_array($run_cart)) {

        $product_id = $fetch_cart['product_id'];
        $result_product = mysqli_query($conn,"select *from products where productID = '$product_id'");
        while($fetch_product = mysqli_fetch_array($result_product)){

            $product_price = array($fetch_product['product_price']);

            $product_title = $fetch_product['product_title'];

            $product_image = $fetch_product['product_image'];

            $single_price = $fetch_product['product_price'];

            $values = array_sum($product_price);

            //getting quantity of product

            $run_qty = mysqli_query($conn,"select *from cart where product_id='$product_id'");
            $row_qty = mysqli_fetch_array($run_qty);
            $qty = $row_qty['quantity'];
            $values_qty = $values * $qty;
            $total += $values_qty;
        }
    }

    echo $total;
}
?>