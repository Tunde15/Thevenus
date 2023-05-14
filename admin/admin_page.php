 <?php include('includes/admin_header.php'); ?>
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


  <?php
if(isset($_POST['upload'])){

    $raw_msg    =   cleandata($_POST['area_msg']);
    $raw_head   =   cleandata($_POST['area_head']);
    $c_msg      =   sanitize($raw_msg);
    $c_head     =   sanitize($raw_head);
    //Collect Front-Image
    $post_pic              =   $_FILES['front-image']['name'];
    $post_pic_tmp          =   $_FILES['front-image']['tmp_name'];
    
    //move image to permanent location
    move_uploaded_file($post_pic_tmp, "uploaded_image/$post_pic");

    $db->query('INSERT INTO admin_post (admin_name, admin_area, admin_lga, admin_heading, admin_msg, admin_postpic, time) VALUES (:name_admin, :area_admin, :lga_admin, :heading, :message, :image, NOW())');

    $db->bindValue(':name_admin', $fullname, PDO::PARAM_STR);
    $db->bindValue(':area_admin', $my_area, PDO::PARAM_STR);
    $db->bindValue(':lga_admin', $my_lga, PDO::PARAM_STR);
    $db->bindValue(':heading', $c_head, PDO::PARAM_STR);
    $db->bindValue(':message', $c_msg, PDO::PARAM_STR);
    $db->bindValue(':image', $post_pic, PDO::PARAM_STR);

    $run_upload = $db->execute();

    
    if($run_upload){
        
        echo'<div class="alert alert-success text-center">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Success!</strong>Your Stories Have Been successfully Uploaded. Thanks
                </div>';
 

    }else{
        
         echo '<div class="alert alert-danger text-center">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Sorry!</strong> Stories Not Uploaded.
                </div>';
    } 

}
?>

<div id="show_area_tbl">
  <!-- Show message when area or street table is successfully created from ajax -->
</div>
 <div class="row">
      <div class="col-lg-2 mb-4">
      </div>
      <div class="col-lg-8 mb-4">
         <h3>Please Upload Your Area Stories Here</h3>
          <div class="card-header">
         <form name="sentMessage" method="post" id="contactForm" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
          <div class="form-group">
            <label class="control-label col-sm-2" for="image"></label>
            <div class="col-sm-10">
              <input type="file" name="front-image" id="image" class="image_inp" onchange="loadFile(event)" onclick="document.getElementById('upload').style.display='none'" >
              <label for="image" class="btn btn-secondary">Choose Image</label>
              <img id="output" width="200" height="200" style="top: 0px!important; position: inherit!important;" >
            </div>
            <div class="control-group form-group">
            <div class="controls">
              <label>Heading:</label>
              <input type="text" class="form-control" id="text" name="area_head"  data-validation-required-message="Please enter your heading.">
              <p class="help-block"></p>
            </div>
          </div>
            <div class="control-group form-group">
            <div class="controls">
              <label>Stories:</label>
              <textarea name="area_msg" style="width:100%; height:150px; resize: none;"></textarea>
            </div>
          </div>
          </div>
          <button type="submit" class="btn btn-primary" id="sendMessageButton" name="upload">Upload</button>
        </form><br>
      </div>
    </div>
  </div>
<script type="text/javascript">
  
  var loadFile = function(event){
    var image = document.getElementById('output');
    image.src = URL.createObjectURL(event.target.files[0]);
  };
</script>
  <!-- /.container -->

  <?php include('includes/footer.php'); ?>