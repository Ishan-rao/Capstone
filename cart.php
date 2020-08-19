<?php
include './includes/navigation.php';
?>
    <?php
    
        if (isset($_SESSION['customer_email'])) {
            
            echo "<b>YOUR EMAIL : </b>".$_SESSION['customer_email'];

        }else{

            echo "";
        }
    
    ?>

<div class="container-fluid">
            <div class="row mt-2">
                <div class="col-md-2 p-4" style="background:#212121">
                    <p class="text-white">YOUR SHOPPING CART</p>
                    <p class="" style="color:#44d62c"><b>Total Items :</b>
                        <?php

                            $ip = get_ip();
                            $run_items = mysqli_query($conn,"select *from cart where ip_address='$ip'");
                            echo $count_items = mysqli_num_rows($run_items);
                        
                        ?>
                    
                    </p>
                    <p  style="color:#44d62c"><b> Total Price : </b>$<?php total_price(); ?> </p>
                </div>
                <div class="col-md-7" >
                <form action="" method="post" enctype="multipart/form-data">
                <table class="table table-borderless" style="background:#212121;color:white">
                  <thead>
                    <tr>
                      <th scope="col">REMOVE</th>
                      <th scope="col">PRODUCT</th>
                      <th scope="col">QUANTITY</th>
                      <th scope="col">PRICE</th>
                    </tr>
                   
                  </thead>
                 
                  <tbody>
              
                  <?php
                        $total=0;
                        $ip = get_ip();
                    
                        $run_cart = mysqli_query($conn,"select *from cart where ip_address='$ip'");
                        while ($fetch_cart = mysqli_fetch_array($run_cart)) {
                    
                            $product_id = $fetch_cart['product_id'];
                            $result_product = mysqli_query($conn,"select *from products where productID = '$product_id'");
                            while($fetch_product = mysqli_fetch_array($result_product)){
                    
                                $product_price = array($fetch_product['product_price']);
                    
                                $product_title = $fetch_product['product_title'];
                    
                                $product_image = $fetch_product['product_image'];
                    
                                $single_price = $fetch_product['product_price'];
                    
                                $values = array_sum($product_price);
                    
                                //getting quantity of product
                    
                                $run_qty = mysqli_query($conn,"select *from cart where product_id='$product_id'");
                                $row_qty = mysqli_fetch_array($run_qty);
                                $qty = $row_qty['quantity'];
                                $values_qty = $values * $qty;
                                $total += $values_qty;
                 
                         
                    
                  ?>
                    <tr>
                      <td> <input type="checkbox" name="remove[]" value="<?php echo $product_id?>">&nbsp;#<?php echo $product_id?></td>
                      <td>
                        <img class="fluid-img" style="height:50px;width:80px" src="./admin_area/product_images/<?php echo $product_image?>" alt="">
                        &nbsp;
                        <span style="color:lightgrey"><?php echo $product_title?></span>
                      </td>
                      <td>
                        <input class="qty_id" data-id="<?php echo $product_id;?>" type="text" size=5 name="qty" value="<?php echo $qty;?>" />
                      </td>
                      <td><?php echo 'cad $'.($single_price*$qty);?></td>
                    </tr>
                         <?php }} ?>


                    <tr>
                      <td><Button class="btn btn-sm" style="background:black;color:#44d62c" type="submit"  name="continue_shopping">Continue Shopping</button></td>
                      <td><Button class="btn btn-sm" style="background:black;color:#44d62c" type="submit"  name="update_cart">Update Cart</button></td>
                      <td>
                      <a href="checkout.php"  class="btn btn-sm mt-1" style="background:black;color:#44d62c">Checkout</a> 
                      </td>
                      <td>Total Price : cad $ <?php echo total_price();?></td>
                    </tr>
                  </tbody>
                </table>
                </form>
                <input type="hidden" value="<?php echo $ip;?>" class="hidden_ip">
                
                <div class="load_ajax"></div>
                <script>
                  $(document).ready(function(){

                    $(".qty_id").on("keyup",function(){

                      var pro_id = $(this).data("id");
                      var qty = $(this).val();
                      var ip = $(".hidden_ip").val();
                      // alert(ip);
                      //update product quatity in ajax and php

                      $.ajax({
                        url:'cart/update_qty_ajax.php',
                        type:'post',
                        data:{id:pro_id,quantity:qty,ip:ip},
                        dataType:'html',
                        success:function(update_qty){
                          // alert(update_qty);
                          
                          if(update_qty==1){
                            
                            // $(".load_ajax").html('Your quantity has been updated successfully');
                          }
                        }
                      });

                      
                    });
                  });

                </script>

                <?php

                  if (isset($_POST['remove'])) {
                    
                    foreach ($_POST['remove'] as $remove_id) {
                      
                      $delete_product = mysqli_query($conn,"delete from cart where product_id = '$remove_id' and ip_address='$ip'");
                      if($delete_product){
                        echo "<script>window.open('cart.php','_self')</script>";
                      }
                    }
                  }

                  if (isset($_POST['continue_shopping'])) {

                    echo "<script>window.open('all_products.php','_self')</script>"; 
                  }
                ?>
                </div>
       
             </div>
</div>

<?php
include './includes/footer.php';
?>
