<?php
session_start();
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
<!-- Bootstrap core CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
<!-- Material Design Bootstrap -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.0/css/mdb.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Holtwood+One+SC&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.0/animate.css">
<style>

</style>
<body>
<style>
.card{
    -webkit-box-shadow: 0px 31px 29px -10px rgba(5,1,5,1);
-moz-box-shadow: 0px 31px 29px -10px rgba(5,1,5,1);
box-shadow: 0px 31px 29px -10px rgba(5,1,5,1);
}
</style>
<div class="container">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4" style="margin-top:150px">
        <h3 class="text-center">
        <img src="./images/adminimg.ico" alt="admin-icon" class="img-fluid" height="30px" width="30px" style="border:2px solid black;border-radius:100px"/> ADMIN - LOGIN</h3>
            <div class="card mt-4">
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1">DARK STREET ID</label>
                        <input type="email" class="form-control" name="email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                    </div>
                    <button type="submit" class="btn btn-block btn-dark" name="login"><h5 style="color:#fffff">LOGIN</h5></button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>
</body>
</html>

<?php

    include '../includes/database.php';

    if(isset($_POST['login'])){
         
        $email = trim(mysqli_real_escape_string($conn,$_POST['email']));

        $password = trim(mysqli_real_escape_string($conn,$_POST['password']));

        $hash_password = $password;

        $select_user = "select *from users where user_email = '$email' AND user_password='$hash_password'";

        $run_user = mysqli_query($conn,$select_user) or die("Error : " . mysqli_error($con));

        $check_user = mysqli_num_rows($run_user);

        if($check_user>0){

            $db_row = mysqli_fetch_array($run_user);

            $_SESSION['email'] = $db_row['user_email'];

            $_SESSION['name'] = $db_row['username'];

            $_SESSION['user_id'] = $db_row['id'];

            $_SESSION['role'] = $db_row['role'];

            if($db_row['role']=='admin'){

                echo "<script>window.open('index.php?logged_in=You have logged In successfully','_self')</script>";
            
            }elseif($db_row['role']=='guest'){

                    echo "<script>alert('Password or Email is wrong.')</script>";
            }
        }else{

            echo "<script>alert('passowrd or Email is wrong ,try again!!')</script>";
        }

    }
?>