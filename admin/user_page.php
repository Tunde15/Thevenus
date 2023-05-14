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
 showmsg();
 ?>
<div id="show_area_tbl">
  <!-- Show message when area or street table is successfully created from ajax -->
</div>
 <?php
 // Checking if the group table is created or not
if (isset($_SESSION['user_data'])){
$my_street =   $_SESSION['user_data']['street'];
$my_area   =   $_SESSION['user_data']['area'];
$my_lga   =   $_SESSION['user_data']['lga'];
$image     =   $_SESSION['user_data']['image'];
$db->query("SELECT * FROM group_tables WHERE area_tbl =:areaname");
$db->bindValue(':areaname', $my_area, PDO::PARAM_STR);
$find_area = $db->fetchSingle();
}
// Checking for area table if it exist
if ($find_area == false){
  $db->query('INSERT INTO group_tables (area_tbl, group_creator) VALUES (:areanme, :creatornme)');
  $db->bindValue(':areanme', $my_area, PDO::PARAM_STR);
  $db->bindValue(':creatornme', $fullname, PDO::PARAM_STR);
  $area_exec = $db->execute();
}

?>
<script>
 /************** Using ajax to create area table to database ******************/ 
  $(document).ready(function(){ 
  $("#create_area_tbl").submit(function(stop_default){ 
  stop_default.preventDefault();
  var url     = $(this).attr("action");
  var data    = $(this).serialize();
  $.post(url, data, function(confirm){
  $("#show_area_tbl").html(confirm);
   });
   });
   });
</script>
<?php
$db->query("SELECT * FROM group_tables WHERE streets_tbl =:streetname");
$db->bindValue(':streetname', $my_street, PDO::PARAM_STR);
$find_street = $db->fetchSingle();
// Checking for street table if it exist
if ($find_street == false) {
  $db->query('INSERT INTO group_tables (streets_tbl, group_creator) VALUES (:streetnme, :creatornme)');
  $db->bindValue(':streetnme', $my_street, PDO::PARAM_STR);
  $db->bindValue(':creatornme', $fullname, PDO::PARAM_STR);
  $street_exec = $db->execute();
}

?>
<script>
/************** Using ajax to create street table to database ******************/ 
  $(document).ready(function(){ 
  $("#create_street_tbl").submit(function(stop_default){ 
  stop_default.preventDefault();
  var url     = $(this).attr("action");
  var data    = $(this).serialize();
  $.post(url, data, function(confirm){
  $("#show_area_tbl").html(confirm);
  });
  });
  });
</script>
            
  <?php
  // php script Showing user info on user page
   $db->query("SELECT * FROM users WHERE user_email = :email");
   $my_email = $_SESSION['user_data']['email'];
   $db->bindValue(':email', $my_email, PDO::PARAM_STR);
   $row = $db->fetchSingle();
  ?>
<!-- Showing user info on user page -->
<?php if ($row): ?>
  <?php
  $back_img = $row['user_back_img'];
  $profile_img = $row['user_img'];
 echo'<div class="backimage" style="background-image: url(uploaded_image/' . $back_img . '); background-color: #3399ff; background-size: 100% 100%;" id="cover_out">';
 ?>
            <!-- <form name="sentMessage" method="post" id="contactForm" enctype="multipart/form-data" action="user_page.php">
              <label class="control-label col-sm-2" for="image" id="coverbtn" onclick="document.getElementById('upload_cover').style.display='block';">Edit cover </label>
              <input type="file" name="image_cover" id="image" class="image_inp" onchange="loadCover(event)">
              <input type="submit" name="upload_cover" value="Save Cover" class="btn btn-secondary" id="upload_cover" style="display:none;">
              </form> -->
              <?php
              echo'<img src="uploaded_image/' . $profile_img . '" height="200px!important;" width="200px!important;" id="output">';
              ?>
              <div class="row">
                <div class="col-lg-4 mb-4">
                </div>
                <div class="col-lg-4 mb-4">
              <form name="sentMessage" method="post" enctype="multipart/form-data" action="user_page.php">
              <label class="control-label col-sm-2" for="image" onclick="document.getElementById('upload_pic').style.display= 'block';">
               <i class='fa fa-camera' style='font-size:24px; position: relative; left: 100px; cursor: pointer!important;'></i>
              </label>
              <input type="file" name="image_pic" id="image" class="image_inp" onchange="loadFile(event)">
              <input type="submit" name="upload_pic" value="Save Pic" class="btn btn-secondary" id="upload_pic" style=" left: 450px; display: none;">
              </form>
            </div>
              </div>
              <!-- <script type="text/javascript">
  
  var loadCover = function(event){
    var image = document.getElementById('cover_out');
    image.src = URL.createObjectURL(event.target.files[0]);
  };

 // $(document).ready(function(){ 
 //  $("#upload_pic").submit(function(stop_default){ 
 //  stop_default.preventDefault();
 //  var url     = $(this).attr("action");
 //  var data    = $(this).serialize();
 //  $.post(url, data, function(confirm){
 //  $("#show_area_tbl").html(confirm);
 //  });
 //  });
 //  });
</script> -->
 <?php
 //             if(isset($_POST['upload_cover'])){
  //              $cover_pic              =   $_FILES['image_cover']['name'];
              
  //              $cover_pic_tmp          =   $_FILES['image_cover']['tmp_name'];
    
  //   //move image to permanent location
  //   move_uploaded_file($cover_pic_tmp, "uploaded_image/$cover_pic");

  //   $db->query('UPDATE users SET user_back_img=:back_img WHERE user_id=:id ');

  //   $db->bindValue(':id', $my_id, PDO::PARAM_INT);
  //   $db->bindValue(':back_img', $cover_pic, PDO::PARAM_STR);

  //   $run_cover = $db->execute();

  //   if($run_cover){
 
  //      echo '<div> 
  //      <h3>Picture Saved Pls<br> Reload Your Page</h3>
  //               </div>';

  //   }
  // }
  ?>
              <script type="text/javascript">
  
  var loadFile = function(event){
    var image = document.getElementById('output');
    image.src = URL.createObjectURL(event.target.files[0]);
  };

 // $(document).ready(function(){ 
 //  $("#upload_pic").submit(function(stop_default){ 
 //  stop_default.preventDefault();
 //  var url     = $(this).attr("action");
 //  var data    = $(this).serialize();
 //  $.post(url, data, function(confirm){
 //  $("#show_area_tbl").html(confirm);
 //  });
 //  });
 //  });
</script>
 <?php
              if(isset($_POST['upload_pic'])){
               $profile_pic              =   $_FILES['image_pic']['name'];
              
               $profile_pic_tmp          =   $_FILES['image_pic']['tmp_name'];
    
    //move image to permanent location
    move_uploaded_file($profile_pic_tmp, "uploaded_image/$profile_pic");

    $db->query('UPDATE users SET user_img=:frt_img WHERE user_id=:id ');

    $db->bindValue(':id', $my_id, PDO::PARAM_INT);
    $db->bindValue(':frt_img', $profile_pic, PDO::PARAM_STR);

    $run_picture = $db->execute();

    if($run_picture){
        
       echo '<div> 
       <h3>Picture Saved Pls<br> Reload Your Page</h3>
                </div>';
    }
  }
  ?>
           </div><br><br><br><br>
           <div class="container">
              <div class="contact">  
              <center>
                <h3 class="names"><?php echo $row["user_name"] ; ?></h3> 
             <a href="edit_userpage.php?my_id= <?php echo $row['user_id'] ?>"> <button class="btn btn-primary">Edit profile <i class='fa fa-edit'></i> </button></a>
            </center>
           </div><br><br>
               <div class="row">
               <div class="col-lg-6 mb-4"> 
                <center><h5>Works</h5></center>
                 <?php 
                  //looping round the work space
                $workgrp = array($row['user_work1'], $row['user_work2'], $row['user_work3']);
                $workgrplgt = count($workgrp);
                  for($x = 0; $x < $workgrplgt; $x++) {
                   echo "<button class='btn btn-info text-light' style='margin-left:4px;'>$workgrp[$x]</button>";
                    }
                ?>
               </div>
                 <div class="col-lg-6 mb-4">
                <!-- the contact space -->
                 <center><h5>Contact</h5></center>
                 <div class="contactlist">
                <?php
                 echo "<span class='fa fa-home' style='font-size:20px'></span><p><strong>Street:</strong> <a href ='#'>{$row['user_street']}</a> <strong>Area:</strong><a href='#'> {$row['user_area']}</a> <strong>LGA:</strong><a href='#'> {$row['user_lga']}</a> <strong>State:</strong> <a href='#'>{$row['user_state']}</a> <strong>Country:</strong><a href='#'> {$row['user_country']}</a></p>"; ?>
                 <?php
                 echo "<span class='fa fa-twitter' style='font-size:20px'></span><a href='#'> {$row['user_twitter']}</a>";?>
                 <?php
                 echo "<span class='fa fa-phone' style='font-size:20px'></span><a href='#'> {$row['user_phone']}</a><br>";
                 ?>
                 <?php
                 echo "<span class='fa fa-instagram' style='font-size:20px'></span><a href='#'>  {$row['user_insta']}</a>";
                 ?>
                 <?php
                 echo"<span class='fa fa-facebook' style='font-size:20px'></span><a href='#'>  {$row['user_fb']}</a><br>";?>
                 <?php
                 echo"<span class='fa fa-envelope' style='font-size:20px'></span><a href='#'>  {$row['user_email']}</a>";?>
                 </div> 
               </div>
             <?php endif; ?>     
           </div> <br><br>
<!-- Area group chat -->
<div class="row change">
<div class="col-lg-6 mb-6" id="area_conv" style="display: none;">
<div id="content" class="content">
<a href="#" class="close close1" data-dismiss="alert" aria-label="close" style="background-color: red!important;">&times;</a>
<center><h4><?php echo $my_area.' '.' Talk' ?></h4></center>
<div class="chat" id="show_area_chats">
<!-- Show area messages -->
</div><br>
<script>
   //Script to show area messages with ajax
$(document).ready(function(){ 
    setInterval(function(){ display_show_area_chat(); }, 4000);
    function display_show_area_chat(){
        $.ajax({       
            url: 'ajax_area_form_get.php',
            type: 'POST',
            success: function(show_report){        
                if(show_report){          
                    $("#show_area_chats").html(show_report);
                }
            }    
        });   
    }
});    
</script>
  <form name="sentMessage" method="post" id="send_area_msg" enctype="multipart/form-data" action="ajax_area_form_post.php">
          <div class="control-group form-group">
            <div class="controls">
              <textarea name="area_msg" style="width:100%; height:60px; resize: none;"></textarea>
              <button type="submit" class="btn btn-primary" id="send_area_btn" name="submit">Send</button>
            </div>
          </div>
        </form>
</div>
<script>
/************** Using ajax to send area messages to the database ******************/ 
$(document).ready(function(){ 
$("#send_area_msg").submit(function(stop_default){ 
stop_default.preventDefault();
var url     = $(this).attr("action");
var data    = $(this).serialize();
$.post(url, data, function(confirm){
$("#show_area_chats").html(confirm);
  });
$("#send_area_msg")[0].reset();
 });
 });
</script>
</div>
<!-- Street group chat -->
<div class="col-lg-6 mb-6" id="street_conv" style="display: none;">  
<div id="content" class="content">
  <a href="#" class="close close2" data-dismiss="alert" aria-label="close" style="background-color: red!important;">&times;</a>
<center><h4><?php echo $my_street.' '.' Talk' ?></h4></center>
<div class="chat" id="show_street_chats">

</div><br>
<script>
   //Script to show street messages with ajax
$(document).ready(function(){ 
    setInterval(function(){ display_show_street_chat(); }, 2000);
    function display_show_street_chat(){
        $.ajax({       
            url: 'ajax_street_form_get.php',
            type: 'POST',
            success: function(show_report){        
                if(show_report){          
                    $("#show_street_chats").html(show_report);
                }
            }    
        });   
    }
});    
</script>
  <form name="sentMessage" method="post" id="send_street_msg" enctype="multipart/form-data" action="ajax_street_form_post.php">
          <div class="control-group form-group">
            <div class="controls">
              <textarea name="street_msg" style="width:100%; height:60px; resize: none;"></textarea>
              <button type="submit" class="btn btn-primary" id="send_street_btn" name="submit">Send</button>
            </div>
          </div>
        </form>
</div>  
</div>
</div>
<script>
/************** Using ajax to send area messages to the database ******************/ 
$(document).ready(function(){ 
$("#send_street_msg").submit(function(stop_default){ 
stop_default.preventDefault();
var url     = $(this).attr("action");
var data    = $(this).serialize();
$.post(url, data, function(confirm){
$("#show_street_chats").html(confirm);
  });
$("#send_street_msg")[0].reset();
 });
 });
</script>

    <!-- Features Section -->
    
    <div class="row">
      <div class="col-lg-6">
        <h2>The Venus Community</h2>
        <p>Get more from our social media community:</p>
        <ul>
          <li>
            <strong>Follow us on instagram</strong>
          </li>
          <li>Follow us on twitter</li>
          <li>Like us on facebook</li>
          <li>Follow us on Linkedin</li>
          <li>email us on tundeajayi@ymail.com</li>
        </ul>
        <p>Get involved and know more about the society you live in...you own it and we can only get the best from it in unity. Get motivated and meet people in your area to begin a better Community.</p>
      </div>
      <div class="col-lg-6">
        <img class="img-fluid rounded" src="" alt="">
      </div>
    </div>
  </div>
    <!-- /.row -->

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

  <!-- /.container -->

  <?php include('includes/footer.php'); ?>