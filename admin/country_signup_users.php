<?php include('includes/header_signup.php'); ?>
<?php
//Include functions
include('includes/functions.php');
?>
                    <?php
$country_id = $_SESSION['user_data']['id_user'];

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
              <label>Country Name:</label>
              <input type="text" class="form-control" id="country" name="country"  data-validation-required-message="Please enter your name.">
              <p class="help-block"></p>
            </div>
          </div>
          <div class="control-group form-group">
            <div class="controls">
              <label>Phone Number:</label>
              <input type="tel" class="form-control" id="Phone_number" name="Phone_number"  data-validation-required-message="Please enter your email.">
              <p class="help-block"></p>
            </div>
          </div>
           <button type="submit" class="btn btn-primary" id="sendMessageButton" name="update">Continue</button>
        </form><br>
      </div>
    </div>
  </div>
  <?php
if(isset($_POST['update'])){
    
    $raw_country        =   cleandata($_POST['country']);
    $raw_phone_no       =   cleandata($_POST['Phone_number']);

    
    $c_country          =   sanitize($raw_country);
    $c_phone_no         =   sanitize($raw_phone_no);

    $db->query('UPDATE users SET user_country=:country, user_phone=:phone WHERE user_id=:id ');
    $db->bindValue(':id', $country_id, PDO::PARAM_INT);
    $db->bindValue(':country', $c_country, PDO::PARAM_STR);
    $db->bindValue(':phone', $c_phone_no, PDO::PARAM_STR);

    $run_country = $db->execute();

    if($run_country){
        
        redirect('social_signup_users.php');

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