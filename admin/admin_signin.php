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

if(isset($_POST['submit'])){
    
    $raw_email       =   cleandata($_POST['email']);
    
    $raw_password    =   cleandata($_POST['password']);
    
//Clean Data
    $c_email         =   valemail($raw_email);            
    
 
    $db->query('SELECT * FROM admin WHERE admin_email =:email AND admin_pass =:password');
    
    $db->bindValue(':email', $c_email, PDO::PARAM_STR);
    $db->bindValue(':password',$raw_password, PDO::PARAM_STR);
    
    $row = $db->fetchSingle();
    
    
    
    if($row){
 
        
        $_SESSION['admin_data'] = array(
        
        'fullname'      =>   $row['admin_name'],
        'id'            =>   $row['admin_id'],
        'email'         =>   $row['admin_email'],
        );
        
        $_SESSION['user_is_logged_in']  =  true;
        
        redirect('admin_page.php');

        $myname = $_SESSION['admin_data']['fullname'];
        
        
        keepmsg('<div class="alert alert-success text-center">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Welcome </strong>' . $myname . ' You are logged in to The Venus admin page. 
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
          <div class="card-header">
        <h3>Sign in to your admin page</h3>
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
        </form>
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