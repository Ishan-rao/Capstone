
<?php

$loginERR="";
if (isset($_POST['login'])) {
    
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

        $run_login= mysqli_query($conn,"select *from users where user_email='$email' and user_password='$password'");
        $check_login = mysqli_num_rows($run_login);
        $row_login = mysqli_fetch_array($run_login);
        if($check_login == 0){
            echo "<script>alert('Incorrect id or password');</script>"; 
            echo "<script>window.open('index.php?action=login','_self')</script>";
        }

        $ip=get_ip();
        $run_cart = mysqli_query($conn,"select *from cart where ip_address='$ip'");
        $check_cart = mysqli_num_rows($run_cart);

        if($check_login>0 AND $check_cart==0){

           $_SESSION['user_id'] = $row_login['id'];
           $_SESSION['role']=$row_login['role'];

            $_SESSION['email'] = $email;
           
            echo "<script>alert('you has logged in')</script>"; 
            echo "<script>window.open('myaccount.php?action=edit_account','_self')</script>";
        
        }else{
            $_SESSION['user_id'] = $row_login['id'];
           $_SESSION['role']=$row_login['role'];

            $_SESSION['email'] = $email;
            echo "<script>alert('you has logged in')</script>"; 
            echo "<script>window.open('checkout.php','_self')</script>";

        }
    }
?>
<style>
body{
  background-image: url("./images/register5.png");
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: 100% 100%;
  z-index:-1;
}
</style>
<div class="container-fluid">
    <div class="row mt-5">
        <div class="col-md-4"></div>
        <div class="col-md-4" style="background:#212121">
                        <!-- Default form login -->
            <form class="p-5" action="" method="post">

            <p class="h5 mb-4" style="color:lightgrey">LogIn Dark Street ID</p>
            <span style="color:#44d62c;font-size:14px"><?php echo $loginERR; ?></span>
           
            <!-- Email -->
            <input type="email" name="email" style="background:black;color:white;border:none" class="form-control" placeholder="*E-mail" required>
            <span class="p-3" style="color:#44d62c;font-size:14px"></span>
            
            <!-- Password -->
            <input type="password" name="password" style="background:black;color:white;border:none" class="form-control mt-4" placeholder="*Password" required>
            <span class="p-3" style="color:#44d62c;font-size:14px"></span>
            <div class="d-flex justify-content-around mt-4">
                
            </div>
            <!-- Sign in button -->
            <button name="login" class="btn btn-block my-4 font-weight-bold" type="submit" style="background:#44d62c;color:black;">Sign in</button>

            <!-- Register -->
            <p style="color:white" class="text-center">Not a member?&nbsp;
                <a href="register.php" style="color:lightgreen">Register</a>
            </p>

            </form>
            <!-- Default form login -->
        </div>
        <div class="col-md-4"></div>
    </div>
</div>
<br/>
