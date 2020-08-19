<?php
         $message = '';
        if (isset($_POST['user_picture'])) {

            //check if file is not empty
                if(!empty($_FILES['customer_image']['name'])){

                    $image    = $_FILES['customer_image']['name'];
                    $image_tmp = $_FILES['customer_image']['tmp_name'];

                    $target_file = "customer/customer_images/".$image;

                    $uploadOk = 1;
                    $message = '';

                    //check if file already existed
                    if(file_exists($target_file)){

                        $uploadOk = 0;
                        $message .="sorry, file already exists.";

                    }else{

                        if(move_uploaded_file($image_tmp,$target_file)){
                            $update_image = mysqli_query($conn,"update users set user_image = '$image' where id = '$_SESSION[user_id]'");
                            $message .= "The file" .basename($image)."has been uploaded";

                        }else{
                            $message .= "Oops,error in uploading...";
                        }
                    }

                }
                
               
               

            

                
            }
          
        
?>

<?php

    $get_user = mysqli_query($conn,"select *from users where id='$_SESSION[user_id]'");
    $fetch_user = mysqli_fetch_array($get_user);
?>
   
        
        <div class="row">
        
            <div class="col-md-6" style="background:#212121">
            <h6 style="color:white;padding:15px;text-align:center"><?php if(isset($message)){ echo $message;}?></h6>
                 <!-- Default form login -->
                <form class="p-5" style="margin-top:-40px" action="" method="post" enctype="multipart/form-data">

                <!-- image -->
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="customer_image">
                    <label class="custom-file-label" style="background:black;color:white;border:none">Choose Image</label>
                </div>

                <img src="./customer/customer_images/<?php echo $fetch_user['user_image'] ?>" height="250px" width="300px" class="img-fluid mt-1">

                <!-- Sign in button -->
                <button name="user_picture" class="btn btn-block my-4 font-weight-bold" type="submit" style="background:#44d62c;color:black;">Save Changes</button>



                </form>
                <!-- Default form login -->
            </div>
        </div>
     
        


<br/>