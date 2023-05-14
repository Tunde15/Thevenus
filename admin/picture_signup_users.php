<?php include('includes/header_signup.php'); ?>
<?php
//Include functions
include('includes/functions.php');
?>
          <?php
$picture_id = $_SESSION['user_data']['id_user'];

?>
<?php
//require database class files
require('includes/pdocon.php');
//instatiating our database objects
$db = new Pdocon;
?>
  <?php
if(isset($_POST['upload'])){

    //Collect Front-Image
    $profile_pic              =   $_FILES['front-image']['name'];
    $profile_pic_tmp          =   $_FILES['front-image']['tmp_name'];
    
    //move image to permanent location
    move_uploaded_file($profile_pic_tmp, "uploaded_image/$profile_pic");

    $db->query('UPDATE users SET user_img=:frt_img WHERE user_id=:id ');

    $db->bindValue(':id', $picture_id, PDO::PARAM_INT);
    $db->bindValue(':frt_img', $profile_pic, PDO::PARAM_STR);

    $run_picture = $db->execute();

    
    if($run_picture){
        
        redirect('signin_users.php');

        keepmsg('<div class="alert alert-success text-center">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Success!</strong>User registered successfully. Please SignIn With Your email and password.
                </div>');
 

    }else{
        
         echo '<div class="alert alert-danger text-center">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Sorry!</strong> User could not be registered.
                </div>';
    } 

}
?>
 <div class="row">
      <div class="col-lg-2 mb-4">
      </div>
      <div class="col-lg-8 mb-4">
         <h3>Please Upload Your Profile Picture</h3>
          <div class="card-header">
        <h3>Signing Up</h3>
         <form name="sentMessage" method="post" id="contactForm" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
          <div class="form-group">
            <label class="control-label col-sm-2" for="image"></label>
            <div class="col-sm-10">
              <input type="file" name="front-image" id="image" class="image_inp" onchange="loadFile(event)" onclick="document.getElementById('upload').style.display='none'" >
              <label for="image" class="btn btn-secondary">Upload image</label>
              <p style="color: red;" id="upload">pls make sure you upload a picture</p>
              <img id="output" width="100" height="100" style="top: 0px!important; position: inherit!important;" >
            </div>
          </div>
          <button type="submit" class="btn btn-primary" id="sendMessageButton" name="upload">Finish Signup</button>
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
<?php include('../includes/footer.php'); ?>  