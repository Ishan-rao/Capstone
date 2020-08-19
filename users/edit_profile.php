<?php
      // $image    = $_FILES['customer_image']['name'];
                // $image_tmp = $_FILES['customer_image']['tmp_name'];
                // //if(isset($_FILES['customer_image'])){}

              
                // if(empty($username)){
                //     $username_ERR = "Username required.";
                // }

                // if(empty($email)){
                //     $email_ERR = "Email-id required.";
                // }

                // if(empty($password)){
                //     $password_ERR = "Password required.";
                // }

                // if(empty($confirm_password)){
                //     $confirm_password_ERR = "confirm Password required.";
                // }

                // if(empty($country)){
                //     $country_ERR = "Country required.";
                // }

                // if(empty($city)){
                //     $city_ERR = "city required.";
                // }

                // if(empty($contact)){
                //     $contact_ERR = "Contact required.";
                // }

                // if(empty($address)){
                //     $address_ERR = "Address required.";
                // }
?>
<?php

$get_user = mysqli_query($conn,"select *from users where id='$_SESSION[user_id]'");
$fetch_user = mysqli_fetch_array($get_user);
?>
<?php

        if (isset($_POST['edit_profile'])) {

                if($_POST['username'] !="" &&
                   $_POST['edit_country'] !='' 
                   && $_POST['city'] != ""
                   && $_POST['contact'] !="" 
                   && $_POST['address'] !="" ){

               
                $username = $_POST['username'];
                $country  = $_POST['edit_country'];
                $city     = $_POST['city'];
                $contact  = $_POST['contact'];
                $address  = $_POST['address'];
                
                $update_profile = mysqli_query($conn,"update users set username='$username',user_country='$country',user_city='$city',user_contact='$contact',user_address='$address' where id='$_SESSION[user_id]'");
                
                if($update_profile){

                    echo "<script>alert('Your profile has been updated successfully.')</script>";
                    echo "<script>window.open(window.location.href,'_self')</script>";
                }
             }
                

        }

          
        
?>



<div class="container-fluid">

    <div class="row">
        <div class="col-md-8" style="background:#212121">
        <div class="container text-center pt-2 mt-2" style="background:black;">
            <span class="navbar-brand" style="color:#44d62c;">
                <h6 class="h6-responsive">
                <span class="font-weight-bold" style='color:#44d62c'>EDIT</span>
                <span class="text-white">PROFILE</span>
                </h6>
            </span>
            </div>
            <!-- Default form login -->
            <form class="p-5" action="" method="post" enctype="multipart/form-data">

            <!-- username -->
            <input type="username" name="username" value="<?php echo $fetch_user['username'] ;?>" style="background:black;color:white;border:none" class="form-control" placeholder="*username" required>
           
             <!-- country -->
             <div class="input-group mt-4">
            <?php include 'edit_country_list.php';?>
            </div>
             <!-- city -->
             <input type="text" name="city" value="<?php echo $fetch_user['user_city'] ;?>" style="background:black;color:white;border:none" class="form-control mt-4" placeholder="*city">

             <!-- contact -->
             <input type="text" name="contact" value="<?php echo $fetch_user['user_contact'] ;?>" style="background:black;color:white;border:none" class="form-control mt-4" placeholder="*contact">
            

             <!-- address -->
             <input type="text" name="address" value="<?php echo $fetch_user['user_address'] ;?>" style="background:black;color:white;border:none" class="form-control mt-4" placeholder="*address">

            <!-- Sign in button -->
            <button name="edit_profile" class="btn btn-block my-4 font-weight-bold" type="submit" style="background:#44d62c;color:black;">SAVE EDIT</button>

            </form>
            <!-- Default form login -->
        </div>
    </div>
</div>
<br/>

