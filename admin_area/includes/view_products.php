<style>
    .delete{
        color:red;
    }
</style>

<form action="" method="post" enctype="multipart/form-data">
<h2 class="text-center">View Products</h2>
<div class="form-inline p-2" style="float:right">
    <input class="form-control" type="search" placeholder="Search product"> &nbsp;
    <i class="fa fa-search" aria-hidden="true"></i>
</div>
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col"><input type="checkbox"> CHECK</th>
      <th scope="col">ID</th>
      <th scope="col">TITLE</th>
      <th scope="col">PRICE</th>
      <th scope="col">IMAGE</th>
      <th scope="col">VIEWS</th>
      <th scope="col">DATE</th>
      <th scope="col">STATUS</th>
      <th scope="col">DELETE</th>
      <th scope="col">EDIT</th>
    </tr>
  </thead>
  <?php
    $all_products = mysqli_query($conn,"select *from products order by productID DESC");

    $i = 1;
    while($row=mysqli_fetch_array($all_products)){
  ?>
  <tbody>
    <tr>
      <th scope="row"><input type="checkbox" name="deleteAll[]" value="<?php echo $row['productID'];?>"></th>
      <td><?php echo $i; ?></td>
      <td><?php echo $row['product_title']?></td>
      <td><?php echo $row['product_price']?></td>
      <td><img src="product_images/<?php echo $row['product_image']?>" alt="" height="50px" width="80px"></td>
      <td><?php echo $row['views']?></td>
      <td><?php echo $row['date']?></td>
      <td><?php
        if($row['visible'] == 1){
            echo "<span style='color:green'>Approved</span>";
        }else{
            echo "<span style='color:red'>Pending</span>";
        }
      ?></td>
      <td><a style="color:red" href="index.php?action=view_pro&delete_product=<?php echo $row['productID'];?>">Delete</a></td>
      <td><a style="color:blue" href="index.php?action=edit_pro&product_id=<?php echo $row['productID'];?>">Edit</a></td>
    </tr>
  </tbody>
    <?php $i++; } ?> 
    <!-- end of while loop -->
    <tr>
        <td>
            <button class="btn btn-sm btn-danger" type="submit" name="delete_all">REMOVE</button>
        </td>
    </tr>
</table>
</form>
<?php

// delete product
if(isset($_GET['delete_product'])){

    $delete_product = mysqli_query($conn,"delete from products where productID ='$_GET[delete_product]' ");

    if($delete_product){

        echo "<script>alert('Product has been deleted successfully !')</script>";
        
        echo "<script>window.open('index.php?action=view_pro','_self')</script>";
    }
}
//delete item selected using foreach loop

if(isset($_POST['deleteAll'])){

    $remove = $_POST['deleteAll'];

    foreach($remove as $key){

        $run_remove = mysqli_query($conn,"delete from products where productID='$key'");
        
        if($run_remove){
        echo "<script>alert('Selected item has been removed successfully !')</script>";
        
        echo "<script>window.open('index.php?action=view_pro','_self')</script>";
 
    }else{
        echo "<script>alert('Error in removing item.')</script>";

    }
}
}

?>