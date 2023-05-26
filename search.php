<?php include('includes/header.php'); ?>
<!-- Search box for user info -->
    <div class="row">
      <div class="col-lg-4 mb-4">
      </div>
      <div class="col-lg-4 mb-4">
        <form name="searchMessage" method="get" id="searchForm" enctype="multipart/form-data" action="search.php">
           <div class="card-body">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search with a word" id="search" name="search">
              <span class="input-group-btn">
                <button class="btn btn-secondary" type="submit" name="searchBtn">Go!</button>
              </span>
            </div>
          </div>
        </form>
      </div>
    </div>
<center><h4>Search Results</h4></center>
    <?php
// Search box search for user info php
    if(isset($_GET['searchBtn'])){ 
       $raw_search  =  cleandata($_GET['search']);
       $c_search    =  sanitize($raw_search);
       $db->query("SELECT * FROM users WHERE user_name LIKE '%$c_search%'
       	or user_email  LIKE '%$c_search'
       	or user_work1  LIKE '%$c_search'
       	or user_work2  LIKE '%$c_search'
       	or user_work3  LIKE '%$c_search'
       	or user_street LIKE '%$c_search'
       	or user_area   LIKE '%$c_search'
       	or user_lga    LIKE '%$c_search'
       	or user_state  LIKE '%$c_search'
       	or user_country LIKE '%$c_search'");
       $show = $db->fetchobj_all();
       ?>
    <?php   if ($show) { ?>
         <div class="row">
      <?php  foreach($show as $show) : ?>  
      <div class="col-lg-6 mb-4">
         <div class="card h-100">
          <?php 
          $myo_img = $show->user_img; 
          echo "<div class='image1' style='background-image: url(admin/uploaded_image/" . $myo_img . ");'>";
           echo '<img src="admin/uploaded_image/' . $myo_img . '" class="img-thumbnail" alt="No Image">'; 
           ?>
          </div>    <br>
              <div class="contact">
                
               <?php echo"<center><h3 class='names'>{$show->user_name}</h3></center>"; ?>

                <?php 
                $workgrp = array($show->user_work1, $show->user_work2, $show->user_work3);
                $workgrplgt = count($workgrp);
                  for($x = 0; $x < $workgrplgt; $x++) {
                   echo "<button style='margin-left:4px;'>$workgrp[$x]</button>";
                    }
                ?>
                 
                 <center><h5>Contact</h5></center>
                 <div class="contactlist">
                  <?php
                 echo "<span class='fa fa-home' style='font-size:20px'></span><p><strong>Street:</strong> <a href ='#'>{$show->user_street}</a> <strong>Area:</strong><a href='#'> {$show->user_area}</a> <strong>LGA:</strong><a href='#'> {$show->user_lga}</a> <strong>State:</strong> <a href='#'>{$show->user_state}</a> <strong>Country:</strong><a href='#'> {$show->user_country}</a></p>"; ?>
                 <?php
                 echo "<span class='fa fa-twitter' style='font-size:20px'></span><a href='#'> {$show->user_twitter}</a>";?>
                 <?php
                 echo "<span class='fa fa-phone' style='font-size:20px'></span><a href='#'> {$show->user_phone}</a><br>";
                 ?>
                 <?php
                 echo "<span class='fa fa-instagram' style='font-size:20px'></span><a href='#'>  {$show->user_insta}</a>";
                 ?>
                 <?php
                 echo"<span class='fa fa-facebook' style='font-size:20px'></span><a href='#'>  {$show->user_fb}</a><br>";?>
                 <?php
                 echo"<span class='fa fa-envelope' style='font-size:20px'></span><a href='#'>  {$show->user_email}</a>";?>
                  
                 
                 </div> 
           </div> 
        </div>
      </div>
    <?php endforeach ; ?>
    <?php }  else{
      echo "<h1>Results Not Found<h1>";
    }
?> 
    <?php  } ?>

    <div class="row mb-4">
      <div class="col-md-8">
        <p></p>
      </div>
      <div class="col-md-4">
        <a class="fixed-bottom" href="#" name="submit"><i class='fa fa-arrow-up' style='font-size:24px'></i></a>
      </div>
    </div>
</div>
    <!-- /.row -->
  
  
<?php include('includes/footer.php'); ?>
   