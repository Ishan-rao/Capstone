<?php

    if(isset($_POST['yes'])){

        $delete_account = mysqli_query($conn,"delete from users where id='$_SESSION[user_id]'");

        session_destroy();
        
        echo "<script>alert('account has been deleted successfully')</script>";
        echo "<script>window.open('index.php','_self')</script>";
    }

    if(isset($_POST['cancel'])){
        
        echo "<script>window.open('myaccount.php','_self')</script>";
    }

?>
<div class="container text-center pt-2 mt-2" style="background:black;">
    <span class="navbar-brand" style="color:#44d62c;">
        <h6 class="h6-responsive">
            <span class="font-weight-bold" style='color:#44d62c'>DELETE</span>
            <span class="text-white">ACCOUNT</span>
        </h6>
     </span>
</div>
<div class="card p-3" style="background:#212121">
    <h6 style="color:white">Are you sure you want to delete your account ?</h6>
    <form action="" method="post">
    <button type="submit" name = "yes" class="btn btn-danger">YES</button>
    <button type="submit" name = "cancel" class="btn btn-success">CANCEL</button>
</form>
</div>

