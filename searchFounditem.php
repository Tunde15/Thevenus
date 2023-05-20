<?php include('includes/founditheader.php'); ?>


<?php

//Include functions
include('admin/includes/functions.php');

//check to see if user if logged in else redirect to index page 

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
        <form name="searchMessage" method="get" id="searchForm" enctype="multipart/form-data" action="searchFounditem.php">
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
       $db->query("SELECT * FROM found_items WHERE item_name LIKE '%$c_search%'");
       $show = $db->fetchMultiple();
       ?>
    <?php   if ($show) { ?>
         <div class="row">
      <?php  foreach($show as $show) : ?>  
        <div class="col-lg-4 changed">
  <div class="media">
    <div class="media-left media-middle">
    <?php
    $itemimg = $show['image'];
      echo'<img src="admin/uploaded_image/'. $itemimg . '" class="media-object" width="150px;" height="100px;">'
      ?>
      <div>
      <?php
      echo"<small>{$show['founder_name']}, {$show['date']}</small>"?>
      </div>
    </div>
    <div class="media-body" style="padding-left: 20px!important;">
    <?php
      echo"<center><h6 style='color: #3399ff;' class='media-heading'><strong>{$show['item_name']}</strong></h6></center>"?>
      <div>
      <?php
      echo"<strong>Found At: </strong><a>{$show['found_at']}</a>"?>
      </div>
      <div>
      <?php
       echo "<strong>Founder Contact: </strong><a> {$show['founder_contact']}</a>
       <strong>Founder Msg: </strong><a> {$show['founder_msg']}</a>";?>
    </div>
  </div>
  <br>
</div>
</div>
<?php endforeach ; ?>
</div>

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
   