<?php include './includes/navigation.php'?>
<style>
    body{
        background:#151515;
    }
</style>
<div class="container-fluid">
    <div class="container">
     <?php if(isset($_SESSION['user_id'])){ ?>
        <div class="row mt-2">
            <div class="col-md-3">
                    <div class="card">
                        <?php 
                            $user_image = mysqli_query($conn,"select *from users where id = '$_SESSION[user_id]'");
                            $run_image = mysqli_fetch_array($user_image);
                            if($run_image['user_image'] != ''){
                                ?>
                                <div class="view overlay">
                                <img class="card-img-top image-fluid" src="./customer/customer_images/<?php echo $run_image['user_image']?>" alt="Card image cap">
                            
                                <?php }else{ ?>
                                    <img class="card-img-top" src="./images/placeholder-profile.jpg" alt="Card image cap">
                                <?php } ?>
                                </div>
                                <p style="background:black;padding:20px;text-align:center"><a href="myaccount.php?action=user_profileIMG" style="background:black;color:grey">Change Profile Picture</a></p>
                                
                            <div class="card-body" style="background:#101010;margin-top:-20px">
                                <p><a href="myaccount.php?action=purchase_history" class="text-white">Purchase History</a></p>
                                <p><a href="myaccount.php?action=edit_account" class="text-white">Edit Account</a></p>
                                <p><a href="myaccount.php?action=edit_profile" class="text-white">Edit Profile</a></p>
                                <p><a href="myaccount.php?action=change_password" class="text-white">Change Password</a></p>
                                <p><a href="myaccount.php?action=delete_account" class="text-white">Delete Account</a></p>
                                <p><a href="logout.php" class="text-white">Logout</a></p>
                            </div>
               </div>
             </div>
                       <?php if($_GET['action'] != 'purchase_history' && $_GET['action'] != 'view_receipt'){?>
                    <div class="col-md-8">

                        <?php
                            if (isset($_GET['action'])) {

                                $action = $_GET['action'];

                            }else{

                                $action = '';
                            }

                            // if ($_GET['action']=='edit_account') {
                            //     echo $action;
                            // }

                            switch($action){
                                case'edit_account';
                                include './users/edit_account.php';
                                break;

                                case'edit_profile';
                                include './users/edit_profile.php';
                                break;

                                case'user_profileIMG';
                                include './users/user_profileIMG.php';
                                break;

                                case'change_password';
                                include './users/change_password.php';
                                break;

                                case'delete_account';
                                include './users/delete_account.php';
                                break;

                                // default;
                                // echo "do something";
                                // break;
                            }
                        ?>
                    
                </div>
                        <?php }elseif($_GET['action']== 'purchase_history'){ ?>

                            <?php include './users/purchase_history.php';?>
                        <?php }elseif($_GET['action'] == 'view_receipt'){?>
                            <?php include 'users/purchase_receipt.php'; ?>
                        <?php }?>
                            
                        
                </div>
                        
                
        <?php }else{ ?>

            <h2>Account setting Page</h2>
            <h5><a href="index.php?action=login">LOGIN NOW</a></h5>
        <?php }?>
        
    </div>
</div>
<br/>                
<?php
include './includes/footer.php';
?>