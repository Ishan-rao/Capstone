<?php

$get_user = mysqli_query($conn,"select *from users where id='$_SESSION[user_id]'");
$fetch_user = mysqli_fetch_array($get_user);
?>
<?php
       $user_already_exit=$wrong_password="";
        if (isset($_POST['edit_account'])) {

                
                $email    = trim($_POST['email']);
                $current_password = trim($_POST['current_password']);
                $hashpassword = $current_password;
                
                $check_exit = mysqli_query($conn,"select *from users where user_email = '$email'");
                $email_count = mysqli_num_rows($check_exit);
                $row_register = mysqli_fetch_array($check_exit);
               
                if($email_count>0){

                    $user_already_exit = "User with this email-id already exit.";

                }elseif(($fetch_user['user_password'] != $hashpassword)){
                   
                    $wrong_password = "You have entered wrong password";
                    $user_already_exit = "User with this email-id already exit.";
                    
                }else{

                    $update_email = mysqli_query($conn,"update users set user_email='$email' where id='$_SESSION[user_id]'");
                    
                    if($update_email){

                        echo "<script>alert('Your Email has been updated successfully!')</script>";
                        
                        echo "<script>window.open(window.location.href,'_self')</script>";
                    }
                }
            }
        
          
        
?>
<style>
</style>
<div class="container-fluid">
    <div class="row">
    
        <div class="col-md-8" style="background:#212121">
        <div class="container text-center pt-2 mt-2" style="background:black;">
            <span class="navbar-brand" style="color:#44d62c;">
                <h6 class="h6-responsive">
                <span class="font-weight-bold" style='color:#44d62c'>EDIT</span>
                <span class="text-white">ACCOUNT</span>
                </h6>
            </span>
            </div>
                        <!-- Default form login -->
            <form class="p-5" action="" method="post" enctype="multipart/form-data">
           
            <!-- Email -->
            <label for="email" style="color:#44d62c;font-weight:bold">Change Email-ID</label>
            <input type="email" name="email" value="<?php echo $fetch_user['user_email'] ?>" style="background:black;color:white;border:none" class="form-control" placeholder="*E-mail" required>
            <span style="color:grey;padding:10px"><?php echo $user_already_exit; ?></span>
            <!-- current password -->
            <input type="password" id="pwd" name="current_password" style="background:black;color:white;border:none" class="form-control mt-4" placeholder="current Password" required>
            <span style="color:grey;padding:10px"><?php echo $wrong_password; ?></span>      
            <!-- Sign in button -->
            <button name="edit_account" class="btn btn-block my-4 font-weight-bold" type="submit" style="background:#44d62c;color:black;">Save</button>

           

            </form>
            <!-- Default form login -->
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