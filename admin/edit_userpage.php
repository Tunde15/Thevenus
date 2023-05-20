<?php include('includes/header.php'); ?>


<?php

//Include functions
include('includes/functions.php');


?>
   <?php 
               
               /************** Fetching data from database using id ******************/
                if(isset($_GET['my_id'])){
                    
                    $user_id   =   $_GET['my_id'];
                 }

                //require database class files
                require('includes/pdocon.php');

                //instatiating our database objects
                $db = new Pdocon;
               
                $db->query("SELECT * FROM users WHERE user_id =:id");
               
                $db->bindValue(':id', $user_id, PDO::PARAM_INT);
               
                $row = $db->fetchSingle();
           ?>
    <?php if($row) : ?>
    <div class="row">
      <div class="col-md-4 col-md-offset-4">
      </div>
      <div class="col-md-4 col-md-offset-4">
           <form class="form-horizontal" role="form" method="post" action="edit_userpage.php?my_id=<?php echo $user_id ?>" enctype="multipart/form-data">
           
           
             
                
                
            <div class="control-group form-group">
            <div class="controls">
              <label>Full Name:</label>
              <input type="text" class="form-control" id="name" name="name"  data-validation-required-message="Please enter your name." value="<?php echo $row['user_name']; ?>">
              <p class="help-block"></p>
            </div>
          </div>
          <div class="control-group form-group">
            <div class="controls">
              <label>Email Address:</label>
              <input type="email" class="form-control" id="email" name="email" required data-validation-required-message="Please enter your email." value="<?php echo $row['user_email']; ?>">
            </div>
          </div>
          <p> Address:</p>
          <div class="control-group form-inline">
            <div class="controls">     
              <input type="text" class="form-control" id="street" name="street" required data-validation-required-message="Please enter your Street." placeholder="Street" value="<?php echo $row['user_street']; ?>">
            </div>
          </div>
          <div class="control-group form-inline">
            <div class="controls">
              <input type="text" class="form-control" id="area" name="area" required data-validation-required-message="Please enter your Area." placeholder="Area" value="<?php echo $row['user_area']; ?>">
            </div>
          </div>
          <div class="control-group form-inline">
            <div class="controls">
              <input type="text" class="form-control" id="lga" name="lga" required data-validation-required-message="Please enter your LGA." placeholder="LGA" value="<?php echo $row['user_lga']; ?>">
            </div>
          </div>
          <div class="control-group form-inline">
            <div class="controls">
              <input type="text" class="form-control" id="state" name="state" required data-validation-required-message="Please enter your State." placeholder="State" value="<?php echo $row['user_state']; ?>">
            </div>
          </div>
          <div class="control-group form-inline">
            <div class="controls">
              <input type="text" class="form-control" id="country" name="country"  placeholder="Country" value="<?php echo $row['user_country']; ?>">
            </div>
          </div>
          <p>Contacts:</p>
          <div class="control-group form-inline">
            <div class="controls">     
              <input type="tel" class="form-control" id="Phone_number" name="Phone_number" placeholder="Phone_number" value="<?php echo $row['user_phone']; ?>">
            </div>
          </div>
          <div class="control-group form-inline">
            <div class="controls">
              <input type="text" class="form-control" id="facebook" name="facebook" placeholder="facebook name" value="<?php echo $row['user_fb']; ?>">
            </div>
          </div>
          <div class="control-group form-inline">
            <div class="controls">
              <input type="text" class="form-control" id="twitter" name="twitter" placeholder="twitter handle" value="<?php echo $row['user_twitter']; ?>">
            </div>
          </div>
          <div class="control-group form-inline">
            <div class="controls">
              <input type="text" class="form-control" id="instagram" name="instagram" placeholder="instagram handle" value="<?php echo $row['user_insta']; ?>">
            </div>
          </div>
          <div class="control-group form-inline">
          <div class="controls">
              <label>Work:</label>
              <input type="text" class="form-control" id="work1" name="work1" placeholder="Work1" value="<?php echo $row['user_work1']; ?>">
            </div>
          </div>
          <div class="control-group form-inline">
            <div class="controls">
              <input type="text" class="form-control" id="work2" name="work2" placeholder="Work2" value="<?php echo $row['user_work2']; ?>">
            </div>
          </div>
          <div class="control-group form-inline">
            <div class="controls">
              <input type="text" class="form-control" id="work3" name="work3" placeholder="Work3" value="<?php echo $row['user_work3']; ?>">
            </div>
          </div>
           
          <!-- For success/fail messages -->
          <button type="submit" class="btn btn-primary pull-right" id="sendMessageButton" name="submit_update">Update</button>
          
          <?php endif; ?>
</form>
          
<?php
/************** Update new Admin ******************/


//Collect and clean values from the form // Collect image and move image to upload_image folder

if(isset($_POST['submit_update'])){

    $raw_name           =   cleandata($_POST['name']);
    $raw_email          =   cleandata($_POST['email']);
    $raw_street         =   cleandata($_POST['street']);
    $raw_area           =   cleandata($_POST['area']);
    $raw_lga            =   cleandata($_POST['lga']);
    $raw_state          =   cleandata($_POST['state']);
    $raw_country        =   cleandata($_POST['country']);
    $raw_work1          =   cleandata($_POST['work1']);
    $raw_work2          =   cleandata($_POST['work2']);
    $raw_work3          =   cleandata($_POST['work3']);
    $raw_phone_no       =   cleandata($_POST['Phone_number']);
    $raw_fb             =   cleandata($_POST['facebook']);
    $raw_twitter        =   cleandata($_POST['twitter']);
    $raw_insta          =   cleandata($_POST['instagram']);

    
    
    $c_name             =   sanitize($raw_name);
    $c_email            =   valemail($raw_email);
    $c_street           =   sanitize($raw_street);
    $c_area             =   sanitize($raw_area);
    $c_lga              =   sanitize($raw_lga);
    $c_state            =   sanitize($raw_state);
    $c_country          =   sanitize($raw_country);
    $c_work1            =   sanitize($raw_work1);
    $c_work2            =   sanitize($raw_work2);
    $c_work3            =   sanitize($raw_work3);
    $c_phone_no         =   sanitize($raw_phone_no);
    $c_fb               =   sanitize($raw_fb);
    $c_twitter          =   sanitize($raw_twitter);
    $c_insta            =   sanitize($raw_insta);
    
  
        $db->query("UPDATE users SET user_name =:fullname, user_email =:email, user_work1 =:work1, user_work2 =:work2, user_work3 = :work3, user_street =:street, user_area =:area, user_lga =:lga, user_state =:state, user_country =:country, user_phone =:phone, user_fb =:fb, user_twitter =:twitter, user_insta =:insta WHERE user_id=:ids");
    $db->bindValue(':ids', $my_id, PDO::PARAM_INT);
    $db->bindValue(':fullname', $c_name, PDO::PARAM_STR);
    $db->bindValue(':email', $c_email, PDO::PARAM_STR);
    $db->bindValue(':work1', $c_work1, PDO::PARAM_STR);
    $db->bindValue(':work2', $c_work2, PDO::PARAM_STR);
    $db->bindValue(':work3', $c_work3, PDO::PARAM_STR);
    $db->bindValue(':street', $c_street, PDO::PARAM_STR);
    $db->bindValue(':area', $c_area, PDO::PARAM_STR);
    $db->bindValue(':lga', $c_lga, PDO::PARAM_STR);
    $db->bindValue(':state', $c_state, PDO::PARAM_STR);
    $db->bindValue(':country', $c_country, PDO::PARAM_STR);
    $db->bindValue(':phone', $c_phone_no, PDO::PARAM_STR);
    $db->bindValue(':fb', $c_fb, PDO::PARAM_STR);
    $db->bindValue(':twitter', $c_twitter, PDO::PARAM_STR);
    $db->bindValue(':insta', $c_insta, PDO::PARAM_STR);
        
        $run = $db->execute();
        
        if($run){
            
            header("location: signin_users.php");
            
            keepmsg('<div class="alert alert-success text-center">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Success!</strong> Update successfully. Please login back
                  </div>');
            
        }else{
            
            header("location: user_page.php");
            
             keepmsg('<div class="alert alert-danger text-center">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Sorry!</strong> Update not successfull
            </div>');
        }
        
        
    }
    
    
    




?>
          
          
          
  </div>
</div>
          
  </div>
</div>
  
<?php include('includes/footer.php'); ?>  