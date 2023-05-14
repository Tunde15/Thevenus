<?php include('includes/header.php'); ?>


<?php

//Include functions
include('admin/includes/functions.php');

//check to see if user if logged in else redirect to index page 


?>

 
<?php

//require or include your database connection file
//require database class files
require('admin/includes/pdocon.php');
    
//instatiating our database objects
$db = new Pdocon;

?>
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

    <?php
      $db->query("SELECT * FROM users");
    
      $results = $db->fetchMultiple();
      
    ?>

    <!-- Marketing Icons Section -->
    <div class="row">
      <?php  foreach($results as $result) : ?>  
      <div class="col-lg-6 mb-4">
         <div class="card h-100">
          <?php 
          $myo_img = $result['user_img']; 
          echo "<div class='image1' style='background-image: url(admin/uploaded_image/" . $myo_img . ");'>";
           echo '<img src="admin/uploaded_image/' . $myo_img . '" class="img-thumbnail" alt="No Image">'; 
           ?>
          </div>    <br>
              <div class="contact">
                
               <?php echo"<center><h3 class='names'>{$result['user_name']}</h3></center>"; ?>

                <?php 
                $workgrp = array($result['user_work1'], $result['user_work2'], $result['user_work3']);
                $workgrplgt = count($workgrp);
                  for($x = 0; $x < $workgrplgt; $x++) {
                   echo "<button style='margin-left:4px;'>$workgrp[$x]</button>";
                    }
                ?>
                 
                 <center><h5>Contact</h5></center>
                 <div class="contactlist">
                  <?php
                 echo "<span class='fa fa-home' style='font-size:20px'></span><p><strong>Street:</strong> <a href ='#'>{$result['user_street']}</a> <strong>Area:</strong><a href='#'> {$result['user_area']}</a> <strong>LGA:</strong><a href='#'> {$result['user_lga']}</a> <strong>State:</strong> <a href='#'>{$result['user_state']}</a> <strong>Country:</strong><a href='#'> {$result['user_country']}</a></p>"; ?>
                 <?php
                 echo "<span class='fa fa-twitter' style='font-size:20px'></span><a href='#'> {$result['user_twitter']}</a>";?>
                 <?php
                 echo "<span class='fa fa-phone' style='font-size:20px'></span><a href='#'> {$result['user_phone']}</a><br>";
                 ?>
                 <?php
                 echo "<span class='fa fa-instagram' style='font-size:20px'></span><a href='#'>  {$result['user_insta']}</a>";
                 ?>
                 <?php
                 echo"<span class='fa fa-facebook' style='font-size:20px'></span><a href='#'>  {$result['user_fb']}</a><br>";?>
                 <?php
                 echo"<span class='fa fa-envelope' style='font-size:20px'></span><a href='#'>  {$result['user_email']}</a>";?>
                  
                 
                 </div> 
           </div> 
        </div>
      </div>
    <?php endforeach ; ?>
    </div>
  
<div class="row mb-4">
      <div class="col-md-8">
        <p></p>
      </div>
      <div class="col-md-4">
        <a class="fixed-bottom" href="#" name="submit"><i class='fa fa-arrow-up' style='font-size:24px'></i></a>
      </div>
    </div>
    <!-- /.row -->
  
  
<?php include('includes/footer.php'); ?>