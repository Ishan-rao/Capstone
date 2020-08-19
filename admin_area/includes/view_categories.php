<style>
    .delete{
        color:red;
    }
</style>

<form action="" method="post" enctype="multipart/form-data">
<h2 class="text-center">View Categories</h2>
<div class="form-inline p-2" style="float:right">
    <input class="form-control" type="search" placeholder="Search category"> &nbsp;
    <i class="fa fa-search" aria-hidden="true"></i>
</div>
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col"><input type="checkbox"> CHECK</th>
      <th scope="col">ID</th>
      <th scope="col">CATEGORY TITLE</th>
      <th scope="col">STATUS</th>
      <th scope="col">DELETE</th>
      <th scope="col">EDIT</th>
    </tr>
  </thead>
  <?php
    $all_categories = mysqli_query($conn,"select *from categories order by categoryID DESC");

    $i = 1;
    while($row=mysqli_fetch_array($all_categories)){
  ?>
  <tbody>
    <tr>
      <th scope="row"><input type="checkbox" name="deleteAll[]" value="<?php echo $row['categoryID'];?>"></th>
      <td><?php echo $i; ?></td>
      <td><?php echo $row['categoryTitle']?></td>
      
      <td><?php
        if($row['visible'] == 1){
            echo "<span style='color:green'>Approved</span>";
        }else{
            echo "<span style='color:red'>Pending</span>";
        }
      ?></td>
      <td><a style="color:red" href="index.php?action=view_cat&delete_cat=<?php echo $row['categoryID'];?>">Delete</a></td>
      <td><a style="color:blue" href="index.php?action=edit_cat&cat_id=<?php echo $row['categoryID'];?>">Edit</a></td>
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
if(isset($_GET['delete_cat'])){

    $delete_cat = mysqli_query($conn,"delete from categories where categoryID ='$_GET[delete_cat]' ");

    if($delete_cat){

        echo "<script>alert('Category has been deleted successfully !')</script>";
        
        echo "<script>window.open('index.php?action=view_cat','_self')</script>";
    }else{

        echo "<script>alert('error')</script>";
        echo "<script>window.open('index.php?action=view_cat','_self')</script>";
    }
}
//delete item selected using foreach loop

if(isset($_POST['deleteAll'])){

    $remove = $_POST['deleteAll'];

    foreach($remove as $key){

        $run_remove = mysqli_query($conn,"delete from categories where categoryID='$key'");
        
        if($run_remove){
        echo "<script>alert('Selected item has been removed successfully !')</script>";
        
        echo "<script>window.open('index.php?action=view_cat','_self')</script>";
 
    }else{
        echo "<script>alert('Error in removing item.')</script>";

    }
}
}

?>