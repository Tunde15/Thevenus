<?php include('includes/header_signup.php'); ?>
<?php
//Include functions
include('includes/functions.php');
?>
          <?php
$work_id = $_SESSION['user_data']['id_user'];

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
              <label>Work1 Name:</label>
              <input type="text" class="form-control" id="work1" name="work1"  data-validation-required-message="Please enter your name.">
              <p class="help-block"></p>
            </div>
          </div>
          <div class="control-group form-group">
            <div class="controls">
              <label>work2 Name:</label>
              <input type="text" class="form-control" id="work2" name="work2"  data-validation-required-message="Please enter your email.">
              <p class="help-block"></p>
            </div>
          </div>
          <div class="control-group form-group">
            <div class="controls">
              <label>work3 Name:</label>
              <input type="text" class="form-control" id="work3" name="work3" required data-validation-required-message="Please enter your Password.">
            </div>
          </div>
          <button type="submit" class="btn btn-primary" id="sendMessageButton" name="update">Continue</button>
        </form><br>
      </div>
    </div>
  </div>

  <?php
if(isset($_POST['update'])){

    $raw_work1          =   cleandata($_POST['work1']);
    $raw_work2          =   cleandata($_POST['work2']);
    $raw_work3          =   cleandata($_POST['work3']);

    
    $c_work1            =   sanitize($raw_work1);
    $c_work2            =   sanitize($raw_work2);
    $c_work3            =   sanitize($raw_work3);

    $db->query('UPDATE users SET user_work1=:work1, user_work2=:work2, user_work3=:work3 WHERE user_id=:id ');

    $db->bindValue(':id', $work_id, PDO::PARAM_INT);
    $db->bindValue(':work1', $c_work1, PDO::PARAM_STR);
    $db->bindValue(':work2', $c_work2, PDO::PARAM_STR);
    $db->bindValue(':work3', $c_work3, PDO::PARAM_STR);

    $run_work = $db->execute();

    
    if($run_work){
        
        redirect('location_signup_users.php');

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