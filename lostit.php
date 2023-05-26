<?php include('includes/founditheader.php');
showmsg();
?>
<!-- Search box for user info -->
    <div class="row">
      <div class="col-lg-8 mb-8">
      <div class="card-body">
        <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="reportLostitem.php"><h6>Lost An Item?</h6></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="reportFounditem.php"><h6>Found An Item?</h6></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="lostit.php"><h6>Lost Items</h6></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="foundit.php"><h6>Found Items</h6></a>
          </li>
         
        </ul>
      </div>
      </div>
      <div class="col-lg-4 mb-4">
        <form name="searchMessage" method="get" id="searchForm" enctype="multipart/form-data" action="searchLostitem.php">
           <div class="card-body">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search items with a word" id="search" name="search">
              <span class="input-group-btn">
                <button class="btn btn-secondary" type="submit" name="searchBtn">Go!</button>
              </span>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="row">
    <div class="col-lg-4 mb-4">
    </div>
    <div class="col-lg-4 mb-4">
      <h4 style="text-align: center;"><ins>Lost Items</ins></h4>
    </div>
    </div>

    <?php
      $db->query("SELECT * FROM lost_items");
    
      $results = $db->fetchobj_all();
      
    ?>

    <!-- Marketing Icons Section -->
    <div class="row">
      <?php  foreach($results as $result) : ?>  
        <div class="col-lg-4 changed">
  <div class="media">
    <div class="media-left media-middle">
    <?php
    $itemimg = $result->image;
      echo'<img src="admin/uploaded_image/'. $itemimg . '" class="media-object" width="150px;" height="100px;">'
      ?>
      <div>
      <?php
      echo"<small>{$result->owner_name}, {$result->date}</small>"?>
      </div>
    </div>
    <div class="media-body" style="padding-left: 20px!important;">
    <?php
      echo"<center><h6 style='color: #3399ff;' class='media-heading'><strong>{$result->item_name}</strong></h6></center>"?>
      <div>
      <?php
      echo"<strong>Lost At: </strong><a>{$result->lost_at}</a>"?>
      </div>
      <div>
      <?php
       echo "<strong>Owner Contact: </strong><a> {$result->owner_contact}</a>
       <br><strong>Owner Msg: </strong><a> {$result->owner_msg}</a>";?>
    </div>
  </div>
  <br>
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