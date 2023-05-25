<?php include('includes/header_signin.php'); ?>
<?php
//Include functions
include('includes/functions.php');
?>
<?php
//require database class files
require('includes/pdocon.php');
//instatiating our database objects
$db = new Pdocon;
//Collect and clean values from the form
if(isset($_POST['submit'])){
    
    $raw_name           =   cleandata($_POST['name']);
    $raw_email          =   cleandata($_POST['email']);
    $raw_password       =   cleandata($_POST['password']);

    
    $c_name             =   sanitize($raw_name);
    $c_email            =   valemail($raw_email);
    $c_password         =   sanitize($raw_password);
    
    $hashed_pass        =   hashpassword($c_password);

    
    $db->query('SELECT * FROM users WHERE user_email=:email');
    
    $db->bindValue(':email', $c_email, PDO::PARAM_STR);
    
     $row = $db->fetchSingle();
    
    if($row){
        
        echo '<div class="alert alert-danger text-center">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Sorry!</strong> Customer Already Exist. Please Register Again
                </div>';
        
    }else{
    
    $db->query('INSERT INTO users (user_id, user_name, user_email, user_pass) VALUES (NULL, :fullname, :email, :password) ');

    $db->bindValue(':fullname', $c_name, PDO::PARAM_STR);
    $db->bindValue(':email', $c_email, PDO::PARAM_STR);
    $db->bindValue(':password', $hashed_pass, PDO::PARAM_STR);

    $run = $db->execute();

    $db->query('SELECT * FROM users WHERE user_email=:email');
    
    $db->bindValue(':email', $c_email, PDO::PARAM_STR);
    
     $row_id = $db->fetchSingle();
    if($run && $row_id){
        $_SESSION['user_data'] = array(

        'id_user'         =>   $row_id['user_id'],
        );
        redirect('work_signup_users.php');

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

}



?>
 <div class="row">
      <div class="col-lg-2 mb-4">
      </div>
      <div class="col-lg-8 mb-4">
         <h3>Create Profile</h3>
        <p>Sign up if you dont have an account, to create your profile/card. If you already have an account <a href="signin_users.php">SignIn</a></p>
          <div class="card-header">
        <h3>SignUp</h3>
         <form name="sentMessage" method="post" id="contactForm" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
          <div class="control-group form-group">
            <div class="controls">
              <label>Full Name:</label>
              <input type="text" class="form-control" id="name" name="name"  data-validation-required-message="Please enter your name.">
              <p class="help-block"></p>
            </div>
          </div>
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
          <button type="submit" class="btn btn-primary" id="sendMessageButton" name="submit">Continue</button></a>
        </form><br>
        <p>You already have an account? <strong><a href="signin_users.php">SignIn</a></strong> to edit your profile.</p>
      </div>
    </div>
  </div>
  <script type="text/javascript">
    function showMypass(){
      var x = document.getElementById('pwd');
      if(x.type === "password"){
        x.type = "text";
      }
      else{
        x.type = "password";
      }
    }
  </script>
<?php include('../includes/footer.php'); ?>  