<?php
        
        if (isset($_POST['change_password'])) {

            $current_password = trim($_POST['current_password']);
            $hash_current_password = $current_password;

            $new_password = trim($_POST['new_password']);
            $hash_new_password = $new_password;
            $confirm_new_password = trim($_POST['confirm_new_password']);
                                
            $select_password = mysqli_query($conn,"select *from users where user_password='$hash_current_password' and id='$_SESSION[user_id]'");

            //check if current password not empty
            
            if(mysqli_num_rows($select_password) == 0){

                echo "<script>alert('Your password is wrong')</script>";

            }elseif($new_password != $confirm_new_password){

                echo "<script>alert('password donot match')</script>";
            }else{

                $update = mysqli_query($conn,"update users set user_password='$hash_new_password' where id = '$_SESSION[user_id]'");
                
                if($update){

                    echo "<script>alert('Password updated successfully')</script>";
                    echo "<script>window.open(window.location.href,'_self')</script>";
                }else{

                    echo "<script>alert('password  change failed !')</script>";
                }
            }
        }
            
          
        
?>

<?php

    $get_user = mysqli_query($conn,"select *from users where id='$_SESSION[user_id]'");
    $fetch_user = mysqli_fetch_array($get_user);
?>

   <div class="container">
      <div class="row">
      
            <div class="col-md-8" style="background:#212121">
            <div class="container text-center pt-2 mt-2" style="background:black;">
            <span class="navbar-brand" style="color:#44d62c;">
                <h6 class="h6-responsive">
                <span class="font-weight-bold" style='color:#44d62c'>CHANGE</span>
                <span class="text-white">PASSWORD</span>
                </h6>
            </span>
            </div> 
            <div style="background:#212121">
                        <!-- Default form login -->
            <form class="p-5" action="" method="post" enctype="multipart/form-data">
                   
            <!--Current Password -->
            <input type="password" name="current_password" style="background:black;color:white;border:none" class="form-control mt-4" placeholder="*Current Password" required>
            <span class="p-3" style="color:#44d62c;font-size:14px"></span>
           
            <!-- New Password -->
            <input type="password" id="pwd" name="new_password" style="background:black;color:white;border:none" class="form-control mt-4" placeholder="*New Password" required>
            <span class="p-3" style="color:#44d62c;font-size:14px"></span>

            <!--Retype Password -->
            <input type="password" id="cpwd" name="confirm_new_password" style="background:black;color:white;border:none" class="form-control mt-3" placeholder="*Re-type Password" required>
            <span class="p-3" style="color:#44d62c;font-size:14px"></span>
            <span id="password_status" class="pt-2"></span>
            <br/>

            <!-- Sign in button -->
            <button name="change_password" class="btn btn-block my-4 font-weight-bold" type="submit" style="background:#44d62c;color:black;">SAVE</button>

           

            </form>
            <!-- Default form login -->
        </div>
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