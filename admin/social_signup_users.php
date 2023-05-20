<?php include('includes/header_signup.php'); ?>
<?php
//Include functions
include('includes/functions.php');
?>
          <?php
$social_id = $_SESSION['user_data']['id_user'];

?>
<?php
//require database class files
require('includes/pdocon.php');
//instatiating our database objects
$db = new Pdocon;
?>
 <div class="row">
      <div class="col-lg-2 mb-4">
      </div>
      <div class="col-lg-8 mb-4">
         <h3>Please Continue Your Application</h3>
          <div class="card-header">
        <h3>Signing Up</h3>
         <form name="sentMessage" method="post" id="contactForm" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
          <div class="control-group form-group">
            <div class="controls">
              <label>Twitter:</label>
              <input type="text" class="form-control" id="facebook" name="facebook"  data-validation-required-message="Please enter your facebook username.">
              <p class="help-block"></p>
            </div>
          </div>
          <div class="control-group form-group">
            <div class="controls">
              <label>Facebook:</label>
              <input type="text" class="form-control" id="twitter" name="twitter">
              <p class="help-block"></p>
            </div>
          </div>
          <div class="control-group form-group">
            <div class="controls">
              <label>Instagram:</label>
              <input type="text" class="form-control" id="instagram" name="instagram">
            </div>
          </div>
          <button type="submit" class="btn btn-primary" id="sendMessageButton" name="update">Continue</button>
        </form><br>
      </div>
    </div>
  </div>

  <?php
if(isset($_POST['update'])){

    $raw_fb             =   cleandata($_POST['facebook']);
    $raw_twitter        =   cleandata($_POST['twitter']);
    $raw_insta          =   cleandata($_POST['instagram']);

    
    $c_fb               =   sanitize($raw_fb);
    $c_twitter          =   sanitize($raw_twitter);
    $c_insta            =   sanitize($raw_insta);

    $db->query('UPDATE users SET user_fb=:fb, user_twitter=:twitter, user_insta=:insta WHERE user_id=:id ');

    $db->bindValue(':id', $social_id, PDO::PARAM_INT);
    $db->bindValue(':fb', $c_fb, PDO::PARAM_STR);
    $db->bindValue(':twitter', $c_twitter, PDO::PARAM_STR);
    $db->bindValue(':insta', $c_insta, PDO::PARAM_STR);

    $run_social = $db->execute();

    
    if($run_social){
        
        redirect('picture_signup_users.php');

        keepmsg('<div class="alert alert-success text-center">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Success!</strong>Please continue Signup.
                </div>');
 

    }else{
        
         echo '<div class="alert alert-danger text-center">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Sorry!</strong> User could not be registered.
                </div>';
    } 

}
?>
<?php include('../includes/footer.php'); ?>  