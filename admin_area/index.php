<?php
session_start();

if(!isset($_SESSION['role']) && $_SESSION['role'] !='admin'){

    echo "<script>window.open('admin_login.php','_self')</script>";
}else{


?>
<?php
    include '../includes/database.php';
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 card" style="height:700px">
            <h2 class=" m-0 text-center" style="padding:10px;">
                <span style="font-weight:bold">DARKSTREET</span>
                <i style="font-size:14px;color:black">Admin panel<hr></i>
            </h2>

            <h5 class="text-center">ADMIN : <?php echo $_SESSION['name'];?></h5>
            <div class="mt-5">
            <p class="text-center">
                <a href="index.php?action=add_pro"><img src="./images/addproduct.png" height="25px" width="25px" />&nbsp; ADD PRODUCT</a>
            </p>
            <p class="text-center">
                <a href="index.php?action=view_pro"><img src="./images/viewproduct.png" height="25px" width="25px" />&nbsp; VIEW PRODUCT</a>
            </p>
            <p class="text-center">
                <a href="index.php?action=add_cat"><img src="./images/addcategory.png" height="25px" width="25px" />&nbsp; ADD CATEGORY</a>
            </p>
            <p class="text-center">
                <a href="index.php?action=view_cat"><img src="./images/viewproduct.png" height="25px" width="25px" />&nbsp; VIEW CATEGORIES</a>
            </p>
            <p class="text-center">
                <a href="index.php?action=add_brands"><img src="./images/addcategory.png" height="25px" width="25px" />&nbsp; ADD BRANDS</a>
            </p>
            <p class="text-center">
                <a href="index.php?action=view_brands"><img src="./images/viewproduct.png" height="25px" width="25px" />&nbsp; VIEW BRANDS</a>
            </p>
            
            <p class="text-center">
                <a href="index.php?action=view_users"><img src="./images/viewproduct.png" height="25px" width="25px" />&nbsp;  USERS LIST</a>
            </p>
            <p class="text-center">
                <a href="index.php?action=view_orders"><img src="./images/addcategory.png" height="25px" width="25px" />&nbsp; VIEW ORDERS</a>
            </p>
 
            </div>
        </div>
        <div class="col-md-10">
        <?php
        include "admin-navbar.php";
        ?>
        
        <!-- add product -->
        <?php

            if(isset($_GET['action'])){
                $action = $_GET['action'];
            }else{
                $action='';
            }
            switch($action){
                case 'add_pro';
                include './includes/insert_product.php';
                break;

                case 'view_pro';
                include './includes/view_products.php';
                break;

                case 'edit_pro';
                include './includes/edit_product.php';
                break;

                case 'add_cat';
                include './includes/insert_category.php';
                break;

                case 'view_cat';
                include './includes/view_categories.php';
                break;

                case 'edit_cat';
                include './includes/edit_category.php';
                break;

                case 'add_brands';
                include './includes/insert_brand.php';
                break;

                case 'view_brands';
                include './includes/view_brand.php';
                break;

                case 'edit_brands';
                include './includes/edit_brands.php';
                break;

                case 'view_users';
                include './includes/view_users.php';
                break;

                case 'view_orders';
                include './includes/view_orders.php';
                break;

                case 'view_receipt';
                include './includes/receipt.php';
                break;
            }
        ?>
        </div>
    </div>
</div>
<?php include "./admin-footer.php";?>
<?php }?>