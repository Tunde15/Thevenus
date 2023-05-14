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
    <!-- Page Heading/Breadcrumbs -->
    <h1 class="mt-4 mb-3">Currently Not Working Now.<br>
    <h1 class="mt-4 mb-3">The Venus Blog<br>
      <small>Know more about the society you live today</small>
    </h1>

    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="index.html">Home</a>
      </li>
      <li class="breadcrumb-item active">Blog Home</li>
    </ol>

    <!-- Blog Post -->
    <?php
      $db->query("SELECT * FROM blogpost");
    
      $results = $db->fetchMultiple();
      
    ?>
    <?php  foreach($results as $result) : ?> 
    <div class="card mb-4">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-4 mb-4">
              <?php 
          $myo_img = $result['blogpic']; 
              echo'<img class="img-fluid rounded" src="admin/uploaded_image/' . $myo_img . '" alt="">'
              ?>
          </div>
          <div class="col-lg-2 mb-4">           
          </div>
          <div class="col-lg-6 mb-4">
            <h2 class="card-title"><?php echo $result['blogtitle']; ?></h2>
            <p class="card-text"><?php echo $result['blogmsg']; ?></p>
            <a href="#" class="btn btn-primary">Read More &rarr;</a>
          </div>
        </div>
      </div>
      <div class="card-footer text-muted">
        Posted on <?php echo $result['blogtime']; ?> by
        <a href="#">The Venus</a>
      </div>
    </div>
<?php endforeach ; ?>
    <!-- Pagination -->
    <ul class="pagination justify-content-center mb-4">
      <li class="page-item">
        <a class="page-link" href="#">&larr; Older</a>
      </li>
      <li class="page-item disabled">
        <a class="page-link" href="#">Newer &rarr;</a>
      </li>
    </ul>


  <!-- /.container -->
<div class="row">
      <div class="col-lg-6">
        <h2>The Venus Community</h2>
        <p>Get more from our social media community:</p>
        <ul>
          <li>
            <strong>Follow us on <i class='fa fa-instagram' style='font-size:24px'></i></strong>
          </li>
          <li>Follow us on <i class='fa fa-twitter-square' style='font-size:24px'></i></li>
          <li>Like us on <i class='fa fa-facebook-square' style='font-size:24px'></i></li>
          <li>Follow us on <i class='fa fa-linkedin' style='font-size:24px'></i></li>
          <li>email us on tundeajayi@ymail.com</li>
        </ul>
        <p>Get involved and know more about the society you live in...you own it and we can only get the best from it in unity. Get motivated and meet people in your area to begin a better Community.</p>
      </div>
      <div class="col-lg-6">
        <img class="img-fluid rounded" src="" alt="">
      </div>
    </div>
     <hr>

    <!-- Call to Action Section -->
    <div class="row mb-4">
      <div class="col-md-8">
        <p></p>
      </div>
      <div class="col-md-4">
        <a class="btn btn-lg btn-secondary btn-block" href="#" name="submit">Back to top</a>
      </div>
    </div>
  <?php include('includes/footer.php'); ?>