<?php include('includes/admin_header.php');
      $results = $admin->area_chat($my_area, $my_lga);
 ?>
    <?php foreach ($results as $result): ?>
 <div class="media">
    <div class="media-left">
        <?php
        $profile_img = $result->user_img;
            echo'<img src="uploaded_image/' . $profile_img . '" class="mr-3 mt-3 rounded-circle" style="width:40px; height:30px; position: static;">';
              ?>    
      </div>
      <div class="media-body">
      <div class="media-header">
        <span>
      <?php echo "Sent on "."<small><i>{$result->time}</i></small>" ?>
    </span>
       
    </div> 
        <?php echo"{$result->user_msg}" ?>
        <div class="media-body" style="background-color: #fff!important;">
       
        <?php echo"{$result->admin_msg}" ?>
    </div>
    </div>
  </div><br>
<?php endforeach; ?>