<?php 
 //require init class and header files
include('includes/header_signin.php');

$admin    = new Admin();
$session = new Session();

showmsg();
//Collect and clean values from the form
if(isset($_POST['submit'])){
    
    $raw_email       =   cleandata($_POST['email']);
    $raw_password    =   cleandata($_POST['password']);
    
//Clean Data
    $c_email         =   valemail($raw_email);            
    $hashed_password =   hashpassword($raw_password);

    $row = $admin->verify_admin($c_email, $hashed_password);
    
    if($row){
        $_SESSION['id'] = $row->admin_id;
        $session->login($row);
        redirect('admin_page.php');
        keepmsg('<div class="alert alert-success text-center">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Welcome </strong>' . $row->admin_name . ' You are logged in to The Venus. 
                </div>');    
    }else{
        
         echo '<div class="alert alert-danger text-center">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Sorry!</strong> User does not exist. Register or check if your email and password is coorect.
            </div>';

    }        
    
}

?>
 <div class="row">
      <div class="col-lg-2 mb-4">
      </div>
      <div class="col-lg-8 mb-4">
         <h3>Edit Profile</h3>
        <p>Sign in if you already have an account, to edit your profile/card</p>
          <div class="card-header">
        <h3>SignIn</h3>
         <form name="sentMessage" method="post" id="contactForm" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
          <div class="control-group form-group">
            <div class="controls">
              <label>Email:</label>
              <input type="email" class="form-control" id="email" name="email"  data-validation-required-message="Please enter your email.">
              <p class="help-block"></p>
            </div>
          </div>
          <div class="control-group form-group">
            <div class="controls">
              <label>Password:</label>
              <input type="Password" class="form-control" id="pwd" name="password" required data-validation-required-message="Please enter your Password.">
              <label>Show Password:</label>
              <input type="checkbox" id="showpass" name="showpass" onclick="showMypass()">
            </div>
          </div>
          <button type="submit" class="btn btn-primary" id="sendMessageButton" name="submit">SignIn</button>
        </form><br>
        <p>You dont have an account? <strong><a href="personal_signup_users.php">SignUp</a></strong> to create your profile.</p>
      </div>
    </div>
  </div>

  <?php include('../includes/footer.php'); ?>  
