 <?php include('includes/header_signin.php'); ?>


<?php

//Include functions
include('includes/functions.php');



?>
 
 
 
<?php
/************** Register new customer ******************/


//require database class files
require('includes/pdocon.php');


//instatiating our database objects
$db = new Pdocon;
showmsg();
//Collect and clean values from the form
if(isset($_POST['submit'])){
    
    $raw_email       =   cleandata($_POST['email']);
    
    $raw_password    =   cleandata($_POST['password']);
    
//Clean Data
    $c_email         =   valemail($raw_email);            
    
    $hashed_password =   hashpassword($raw_password);
      
    
    $db->query('SELECT * FROM users WHERE user_email =:email AND user_pass =:password');
    
    $db->bindValue(':email', $c_email, PDO::PARAM_STR);
    $db->bindValue(':password',$hashed_password, PDO::PARAM_STR);
    
    $row = $db->fetchSingle();
    
    
    if($row){
        
        $d_image        =   $row['user_img'];
        
        $d_name         =   $row['user_nicename'];
        
        $s_image        =   "<img src='uploaded_image/$d_image' height='40px!important;' width='40px!important;' style='position:static!important;' />"; 
        
        $_SESSION['user_data'] = array(
        
        
        'fullname'      =>   $row['user_name'],
        'id'            =>   $row['user_id'],
        'email'         =>   $row['user_email'],
        'street'        =>   $row['user_street'],
        'area'          =>   $row['user_area'],
        'lga'           =>   $row['user_lga'],
        'imgsent'       =>   $row['user_img'],
        'image'         =>   $s_image

        );
        
        $_SESSION['user_is_logged_in']  =  true;
        
        redirect('user_page.php');

        $myname = $_SESSION['user_data']['fullname'];
        
        
        keepmsg('<div class="alert alert-success text-center">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Welcome </strong>' . $myname . ' You are logged in to The Venus. 
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
