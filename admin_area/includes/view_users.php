<style>
    .delete{
        color:red;
    }
</style>

<form action="" method="post" enctype="multipart/form-data">
<h2 class="text-center">View Users</h2>
<div class="form-inline p-2" style="float:right">
    <input class="form-control" type="search" placeholder="Search product"> &nbsp;
    <i class="fa fa-search" aria-hidden="true"></i>
</div>
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col"><input type="checkbox"> CHECK</th>
      <th scope="col">ID</th>
      <th scope="col">USERNAME</th>
      <th scope="col">EMAIL</th>
      <th scope="col">IMAGE</th>
      <th scope="col">STATUS</th>
      <th scope="col">DELETE</th>
       
    </tr>
  </thead>
  <?php
    $all_users = mysqli_query($conn,"select *from users order by id DESC");

    $i = 1;
    while($row=mysqli_fetch_array($all_users)){
  ?>
  <tbody>
    <tr>
      <th scope="row"><input type="checkbox" name="deleteAll[]" value="<?php echo $row['id'];?>"></th>
      <td><?php echo $i; ?></td>
      <td><?php echo $row['username']?></td>
      <td><?php echo $row['user_email']?></td>



      <td>
          <?php if($row['user_image'] != ''){ ?>
          <img src="../upload-files/<?php echo $row['user_image']?>" alt="" height="50px" width="80px">
          <?php }else{?>
            <img src="../images/placeholder-profile.jpg" alt="" height="50px" width="80px">
          <?php } ?>
        </td>
      
      
      
      
      <td><?php
        if($row['visible'] == 1){
            echo "<span style='color:green'>Approved</span>";
        }else{
            echo "<span style='color:red'>Pending</span>";
        }
      ?></td>
      <td><a style="color:red" href="index.php?action=view_users&delete_user=<?php echo $row['id'];?>">Delete</a></td>
      
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

// delete user account
if(isset($_GET['delete_user'])){

    $delete_user = mysqli_query($conn,"delete from users where id ='$_GET[delete_user]' ");

    if($delete_user){

        echo "<script>alert('User Account has been deleted successfully !')</script>";
        
        echo "<script>window.open('index.php?action=view_users','_self')</script>";
    }
}
//delete item selected using foreach loop

if(isset($_POST['deleteAll'])){

    $remove = $_POST['deleteAll'];

    foreach($remove as $key){

        $run_remove = mysqli_query($conn,"delete from users where id='$key'");
        
        if($run_remove){
        echo "<script>alert('Selected user account has been removed successfully !')</script>";
        
        echo "<script>window.open('index.php?action=view_users','_self')</script>";
 
    }else{
        echo "<script>alert('Error in removing item.')</script>";

    }
}
}

?>