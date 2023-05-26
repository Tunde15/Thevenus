<?php include('includes/header.php');
 showmsg();
 ?>
<div id="show_area_tbl">
  <!-- Show message when area or street table is successfully created from ajax -->
</div>
 <?php
 // Checking if the group table is created or not
  $area_tblresult = $user->check_forarea_grptbl($my_area);

// Checking for area table if it exist
if ($area_tblresult == false){
  $user->insert_areatbl($my_area, $my_name);
}

?>
<?php
 // Checking if the group table is created or not
$str_tblresult = $user->check_forstr_grptbl($my_street);
// Checking for street table if it exist
if ($str_tblresult == false) {
  $user->insert_strtbl($my_street, $my_name);
}

?>
<!-- Showing user info on user page -->
<?php if ($result): ?>
  <?php
    $back_img = $result->user_back_img;
    $profile_img = $result->user_img;

 echo'<div class="backimage" style="background-image: url(uploaded_image/' . $back_img . '); background-color: #3399ff; background-size: 100% 100%;" id="cover_out">';
 ?>
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
 <?php
    if(isset($_POST['upload_pic'])){
        $profile_pic              =   $_FILES['image_pic']['name'];
        $profile_pic_tmp          =   $_FILES['image_pic']['tmp_name'];

        $run_picture = $user->upd_profilepic($profile_pic_tmp, $profile_pic, $my_id);

    if($run_picture){
        
       echo '<div> 
       <h3 style="color: blue;">Picture Saved Pls<br> Reload Your Page</h3>
                </div>';
    }
  }
  ?>
           </div><br><br><br><br>
           <div class="container">
              <div class="contact">  
              <center>
                <h3 class="names"><?php echo $result->user_name ; ?></h3> 
             <a href="edit_userpage.php?my_id= <?php echo $result->user_id ?>"> <button class="btn btn-primary">Edit profile <i class='fa fa-edit'></i> </button></a>
            </center>
           </div><br><br>
               <div class="row">
               <div class="col-lg-6 mb-4"> 
                <center><h5>Works</h5></center>
                 <?php 
                  //looping round the work space
                $workgrp = array($result->user_work1, $result->user_work2, $result->user_work3);
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
                 echo "<span class='fa fa-home' style='font-size:20px'></span><p><strong>Street:</strong> <a href ='#'>{$result->user_street}</a> <strong>Area:</strong><a href='#'> {$result->user_area}</a> <strong>LGA:</strong><a href='#'> {$result->user_lga}</a> <strong>State:</strong> <a href='#'>{$result->user_state}</a> <strong>Country:</strong><a href='#'> {$result->user_country}</a></p>"; ?>
                 <?php
                 echo "<span class='fa fa-twitter' style='font-size:20px'></span><a href='#'> {$result->user_twitter}</a>";?>
                 <?php
                 echo "<span class='fa fa-phone' style='font-size:20px'></span><a href='#'> {$result->user_phone}</a><br>";
                 ?>
                 <?php
                 echo "<span class='fa fa-instagram' style='font-size:20px'></span><a href='#'>  {$result->user_insta}</a>";
                 ?>
                 <?php
                 echo"<span class='fa fa-facebook' style='font-size:20px'></span><a href='#'>  {$result->user_fb}</a><br>";?>
                 <?php
                 echo"<span class='fa fa-envelope' style='font-size:20px'></span><a href='#'>  {$result->user_email}</a>";?>
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
    <script> 
    ushowArea(); 
    ucreateAreatbl();
    ucreateStrtbl();
    ushowArea();
    ushowStr();
    </script>

  <!-- /.container -->

  <?php include('includes/footer.php'); ?>