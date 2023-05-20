<?php include('includes/header.php'); ?>
<?php
//Include functions
include('includes/functions.php');
?>
 
 
 
<?php
//require database class files
require('includes/pdocon.php');

//instatiating our database objects
$db = new Pdocon;
 ?>
<?php
      $db->query('SELECT * FROM area_chat WHERE area_name =:name_area AND lga_name =:name_lga');
      $db->bindValue(':name_area', $my_area, PDO::PARAM_STR);
      $db->bindValue(':name_lga', $my_lga, PDO::PARAM_STR);
      $results = $db->fetchMultiple();  
      $image     =   $_SESSION['user_data']['image']; 
    ?>
    <?php foreach ($results as $result): ?>
 <div class="media">
    <div class="media-left">
        <?php
        $profile_img = $result['user_img'];
            echo'<img src="uploaded_image/' . $profile_img . '" class="mr-3 mt-3 rounded-circle" style="width:40px; height:30px; position: static;">';
              ?>       
      </div>
      <div class="media-body">
      <div class="media-header">
        <span>
      <?php echo "Sent on "."<small><i>{$result['time']}</i></small>" ?>
    </span>
       <?php echo "<h6 href=''>{$result['user_name']}</h6>" ?>
    </div> 
        <?php echo"{$result['user_msg']}" ?>
        <div class="media-body" style="background-color: blue!important;">
       
        <?php echo"{$result['admin_msg']}" ?>
    </div>
    </div>
  </div>
<br>
<?php endforeach; ?>