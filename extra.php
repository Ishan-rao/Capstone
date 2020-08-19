<div class="fluid-container">
<nav class="navbar navbar-expand-lg">
  <span class="navbar-brand" style="color:#44d62c">
  <h5 class="text-center h5-responsive">
    <span class="font-weight-bold" style='color:#44d62c'>PRODUCT</span>
    <span class="text-white"> EXPLORE</span>
  </h5>
  </span>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <span class="font-weight-bold" style="font-size:16px">Categories</span> 
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
        <?php
         fetch_categories();
        ?>
        </div>
        
      </li>
    </ul>
    <ul class="navbar-nav">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="font-weight-bold" style="font-size:16px">Brands</span> 
        </a>
        <div class="dropdown-menu text-white" aria-labelledby="navbarDropdownMenuLink">
          <?php
           fetch_brands();
        ?>
        </div>
      </li>
    </ul>
  </div>
</nav>
</div>
<!-- product display -->
<div class="fluid-container">
<?php
fetch_product();
?>
<?php
getProductByCategory();
?>
<!-- brand selection -->
<?php
getProductByBrand();
?>

</div>