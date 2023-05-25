<?php include('includes/header_signup.php'); ?>
<?php
//Include functions
include('includes/functions.php');
?>
          <?php
$location_id = $_SESSION['user_data']['id_user'];

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
              <label>Street Name:</label>
              <input type="text" class="form-control" placeholder="Enter only your street name without space" id="street" name="street" required data-validation-required-message="Please enter your street name.">
              <p class="help-block"></p>
            </div>
          </div>
          <div class="control-group form-group">
            <div class="controls">
              <label>Area Name:</label>
              <input type="text" class="form-control" id="area" name="area" required data-validation-required-message="Please enter your area name.">
              <p class="help-block"></p>
            </div>
          </div>
          <div class="control-group form-group">
            <div class="controls">
              <label>LGA:</label>
              <input type="text" class="form-control" id="lga" name="lga" required data-validation-required-message="Please enter your lga name.">
            </div>
          </div>
          <div class="control-group form-group">
            <div class="controls">
              <label>State Name:</label>
              <input type="text" class="form-control" id="state" name="state" required data-validation-required-message="Please enter your state name.">
            </div>
          </div>
          <button type="submit" class="btn btn-primary" id="sendMessageButton" name="update">Continue</button>
        </form><br>
      </div>
    </div>
  </div>

  <?php
if(isset($_POST['update'])){

    $raw_street         =   cleandata($_POST['street']);
    $raw_area           =   cleandata($_POST['area']);
    $raw_lga            =   cleandata($_POST['lga']);
    $raw_state          =   cleandata($_POST['state']);

    
    $c_street           =   sanitize($raw_street);
    $c_area             =   sanitize($raw_area);
    $c_lga              =   sanitize($raw_lga);
    $c_state            =   sanitize($raw_state);

    $db->query('UPDATE users SET user_street=:street, user_area=:area, user_lga=:lga, user_state=:state WHERE user_id=:id ');

    $db->bindValue(':id', $location_id, PDO::PARAM_INT);
    $db->bindValue(':street', $c_street, PDO::PARAM_STR);
    $db->bindValue(':area', $c_area, PDO::PARAM_STR);
    $db->bindValue(':lga', $c_lga, PDO::PARAM_STR);
    $db->bindValue(':state', $c_state, PDO::PARAM_STR);

    $run_location = $db->execute();

    
    if($run_location){
        
        redirect('country_signup_users.php');

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