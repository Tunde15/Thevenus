<?php include('includes/header.php');
      $results = $user->str_chat($my_street, $my_area, $my_lga);
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
       <?php echo "<h6 href=''>{$result->user_name}</h6>" ?>
    </div> 
        <?php echo"{$result->user_msg}" ?>
    </div>
  </div><br>
<?php endforeach; ?>