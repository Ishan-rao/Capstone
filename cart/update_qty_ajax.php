
<?php

include '../includes/database.php';
if(isset($_POST['id'])){

    $update_quantity = mysqli_query($conn,"update cart set quantity='$_POST[quantity]' where ip_address='$_POST[ip]' and product_id='$_POST[id]'");

    if($update_quantity){

        echo 1;
    }
}
?>