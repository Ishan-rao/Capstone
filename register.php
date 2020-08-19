<?php

include './includes/navigation.php';
?>


<?php
        $username_ERR=$email_ERR=$password_ERR=$confirm_password_ERR=$country_ERR=$city_ERR=$contact_ERR=$address_ERR="";
        $user_already_exit=$insert_success=$insert_failure="";
        if (isset($_POST['register'])) {

                $ip = get_ip();
                $username = $_POST['username'];
                $email    = trim($_POST['email']);
                $password = trim($_POST['password']);
                $hashpassword = $password;
                $confirm_password = trim($_POST['confirm_password']);
                $country  = $_POST['edit_country'];
                $city     = $_POST['city'];
                $contact  = $_POST['contact'];
                $address  = $_POST['address'];
                
                $image    = $_FILES['customer_image']['name'];
                $image_tmp = $_FILES['customer_image']['tmp_name'];
                //if(isset($_FILES['customer_image'])){}
                 
              
                if(empty($username)){
                    $username_ERR = "Username required.";
                }

                if(empty($email)){
                    $email_ERR = "Email-id required.";
                }

                if(empty($password)){
                    $password_ERR = "Password required.";
                }

                if(empty($confirm_password)){
                    $confirm_password_ERR = "confirm Password required.";
                }

                if(empty($country)){
                    $country_ERR = "Country required.";
                }

                if(empty($city)){
                    $city_ERR = "city required.";
                }

                if(empty($contact)){
                    $contact_ERR = "Contact required.";
                }

                if(empty($address)){
                    $address_ERR = "Address required.";
                }

                $check_exit = mysqli_query($conn,"select *from users where user_email = '$email'");
                $email_count = mysqli_num_rows($check_exit);
                $row_register = mysqli_fetch_array($check_exit);
                
                if($email_count>0){

                    $user_already_exit = "User with this email-id already exit. <a href='' style='color:#44d62c'>LOGIN NOW !</a>";

                }else{
                    move_uploaded_file($image_tmp,"./customer/customer_images/$image");
                    $sql ="insert into users(ip_address,username,user_email,user_password,user_country,user_city,user_contact,user_address,user_image)values('$ip','$username','$email','$hashpassword','$country','$city','$contact','$address','$image');";
                    
					$insert_customer = mysqli_query($conn,$sql);

                    if($insert_customer){

                        $select_user = mysqli_query($conn,"select *from users where user_email = '$email'");
                        $fetch_user = mysqli_fetch_array($select_user);

                        echo $_SESSION['user_id'] = $fetch_user['id'];
                        echo $_SESSION['role']    = $fetch_user['role'];
                    }

                    $cart_data = mysqli_query($conn,"select *from cart where ip_address ='$ip'");
                    $check_cart = mysqli_num_rows($cart_data);

                    if($check_cart==0){
                        $_SESSION['email'] = $email;
                        echo "<script>alert('Account has been created')</script>";
                        echo "<script>window.open('myaccount.php?action=edit_account','_self')</script>";
                    }else{

                        $_SESSION['email'] = $email;
                        echo "<script>alert('account has been created')</script>";
                        echo "<script>window.open('checkout.php','_self')</script>";

                    }
                    // if($insert_customer){

                    //     $insert_success="You're successfully regiestered, <a href='all_products/login.php' style='color:#44d62c'>Login now.</a>";

                    // }else{
                        
                    //     $insert_failure = "Registration failed, please try again";
                    // }

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
</style>
<div class="container-fluid">

<div class="row">
<div class="col-md-4"></div>
<div class="col-md-4">
<div class="text-center p-2 mt-3" style="color:lightgrey;">
        <span class="h6 h6-responsive" style="background:black"><?php echo $insert_success;?></span>
        <span><?php echo $insert_failure;?></span>
        <span class="h6 h6-responsive"><?php echo $user_already_exit?></span>
        </div>
</div>
<div class="col-md-4"></div>
</div>

    <div class="row mt-5">
          <div class="col-md-4"></div>
        <div class="col-md-4" style="background:#212121">
                        <!-- Default form login -->
            <form class="p-5" action="register.php" method="post" enctype="multipart/form-data">

            <p class="h5 mb-4" style="color:lightgrey">Register to Dark Street</p>

            <!-- username -->
            <input type="username" name="username" style="background:black;color:white;border:none" class="form-control" placeholder="*username" required>
            <span class="p-3" style="color:#44d62c;font-size:14px"><?php echo   $username_ERR;?></span>
           
            <!-- Email -->
            <input type="email" name="email" style="background:black;color:white;border:none" class="form-control" placeholder="*E-mail" required>
            <span class="p-3" style="color:#44d62c;font-size:14px"><?php echo   $email_ERR;?></span>
            
            <!-- Password -->
            <input type="password" id="pwd" name="password" style="background:black;color:white;border:none" class="form-control mt-4" placeholder="*Password" required>
            <span class="p-3" style="color:#44d62c;font-size:14px"><?php echo   $password_ERR;?></span>

            <!--confirm Password -->
            <input type="password" id="cpwd" name="confirm_password" style="background:black;color:white;border:none" class="form-control mt-3" placeholder="*confirm-Password" required>
            <span class="p-3" style="color:#44d62c;font-size:14px"><?php echo   $confirm_password_ERR;?></span>
            <span id="password_status" class="pt-2"></span>
            <br/>
            <!-- image -->
            <div class="custom-file">
                <input type="file" class="custom-file-input" name="customer_image">
                <label class="custom-file-label" style="background:black;color:white;border:none">Choose Image</label>
            </div>

             <!-- country -->
             <div class="input-group mt-4">
            <?php include './includes/country.php';?>
            </div>
             <!-- city -->
             <input type="text" name="city" style="background:black;color:white;border:none" class="form-control mt-4" placeholder="*city" required>
            <span class="p-3" style="color:#44d62c;font-size:14px"><?php echo   $city_ERR;?></span>

             <!-- contact -->
             <input type="text" name="contact" style="background:black;color:white;border:none" class="form-control mt-4" placeholder="*contact" required>
            <span class="p-3" style="color:#44d62c;font-size:14px"><?php echo   $contact_ERR;?></span>

             <!-- address -->
             <input type="text" name="address" style="background:black;color:white;border:none" class="form-control mt-4" placeholder="*address" required>
            <span class="p-3" style="color:#44d62c;font-size:14px"><?php echo   $address_ERR;?></span>

            <!-- Sign in button -->
            <button name="register" class="btn btn-block my-4 font-weight-bold" type="submit" style="background:#44d62c;color:black;">Register</button>

            <!-- Register -->
            <p style="color:white" class="text-center">Already have an account?&nbsp;
                <a href="checkout.php?action=login" style="color:lightgreen">Login Now.</a>
            </p>

            </form>
            <!-- Default form login -->
        </div>
        <div class="col-md-4">
        </div>
    </div>
</div>
<br/>
<script>
    $(document).ready(function(){

        $("#cpwd").on("keyup",function(){

            var pwd = $("#pwd").val();
            var cpwd = $("#cpwd").val();

            if(pwd==cpwd){

                $("#password_status").html("<b style='color:#44d62c;'>Password match</b>");
            }else{
                $("#password_status").html("<b style='color:red;'>Password do not match</b>");
            }
        });
    });
</script>
<?php
include './includes/footer.php';
?>