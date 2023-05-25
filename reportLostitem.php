<?php include('includes/reportitemheader.php'); ?>
<?php
//Include functions
include('admin/includes/functions.php');
?>
<?php
//require database class files
require('admin/includes/pdocon.php');
//instatiating our database objects
$db = new Pdocon;
//Collect and clean values from the form
if(isset($_POST['submit'])){
    
    $raw_name             =   cleandata($_POST['item_name']);
    $raw_lostat           =   cleandata($_POST['lost_at']);
    $raw_ownercontact     =   cleandata($_POST['owner_contact']);
    $raw_ownername        =   cleandata($_POST['owner_name']);
    $raw_ownermsg         =   cleandata($_POST['owner_msg']);

    
    $c_name               =   sanitize($raw_name);
    $c_lostat             =   sanitize($raw_lostat);
    $c_ownercontact       =   sanitize($raw_ownercontact);
    $c_ownername          =   sanitize($raw_ownername);
    $c_ownermsg           =   sanitize($raw_ownermsg);

    //Collect Front-Image
    $item_pic              =   $_FILES['lost_image']['name'];
    $item_pic_tmp          =   $_FILES['lost_image']['tmp_name'];
    // Collecting info to send to the mail
    // $to = "tundeajayi@ymail.com";
    // $email_subject = "Found Item Report";
    // $email_body = "item picture: $item_pic \n item name: $c_name \n lost at: $c_lostat \n owner contact: $c_ownercontact \n owner name: $c_ownername \n owner msg: $c_ownermsg";
    // mail($to, $email_subject, $email_body);
    
    //move image to permanent location
    move_uploaded_file($item_pic_tmp, "admin/uploaded_image/$item_pic");

    
    $db->query('INSERT INTO lost_items (id, item_name, lost_at, owner_contact, owner_name, owner_msg, date, image) VALUES (NULL, :itemname, :itemfound, :itemcontact, :itemowner, :itemmsg, NOW(), :image) ');

    $db->bindValue(':itemname', $c_name, PDO::PARAM_STR);
    $db->bindValue(':itemfound', $c_lostat, PDO::PARAM_STR);
    $db->bindValue(':itemcontact', $c_ownercontact, PDO::PARAM_STR);
    $db->bindValue(':itemowner', $c_ownername, PDO::PARAM_STR);
    $db->bindValue(':itemmsg', $c_ownermsg, PDO::PARAM_STR);
    $db->bindValue(':image', $item_pic, PDO::PARAM_STR);

    $run = $db->execute();
    
    if($run){
      redirect('lostit.php');

      keepmsg('<div class="alert alert-success text-center">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success!</strong>You have report an item and it will be shown through all our platform to find it for you.
              </div>');
    
         

  }else{
      
       echo '<div class="alert alert-danger text-center">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Sorry!</strong> Something went wrong and your report is not successfull.
              </div>';
  } 

}



?>
 <div class="row">
      <div class="col-lg-2 mb-4">
      </div>
      <div class="col-lg-8 mb-4">
         <h3>Report An Item Lost</h3>
         <div class="alert alert-danger text-center">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Warning!</strong> Return all items to any organisation that indicate on the item where to return if lost and found. Thank you
            </div>
          <div class="card-header">
        <h3>Report</h3>
         <form name="sentMessage" method="post" id="contactForm" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
          <div class="control-group form-group">
            <div class="controls">
              <label><p style="color: red; display:inline-block">*</p>Item Name:</label>
              <input type="text" class="form-control" id="name" name="item_name"  required data-validation-required-message="Please enter item name." placeholder="Enter item name">
              <p class="help-block"></p>
            </div>
          </div>
          <div class="control-group form-group">
            <div class="controls">
              <label><p style="color: red; display:inline-block">*</p>Lost Item At:</label>
              <input type="text" class="form-control" id="name" name="lost_at"  required data-validation-required-message="Please enter location of where you lost the item." placeholder="Location of where you lost the item">
              <p class="help-block"></p>
            </div>
          </div>
          <div class="control-group form-group">
            <div class="controls">
              <label><p style="color: red; display:inline-block">*</p>Owners Contact:</label>
              <input type="text" class="form-control" id="name" name="owner_contact"  required data-validation-required-message="Please enter the contact where we can reach you." placeholder="Contact where we can reach you">
              <p class="help-block"></p>
            </div>
          </div>
          <div class="control-group form-group">
            <div class="controls">
              <label><p style="color: red; display:inline-block">*</p>First Name:</label>
              <input type="text" class="form-control" id="name" name="owner_name"  data-validation-required-message="Please enter your first name." placeholder="Only Your First Name">
              <p class="help-block"></p>
            </div>
          </div>
          <div class="control-group form-group">
            <div class="controls">
            <label><p style="color: red; display:inline-block">*</p>Your Message:</label>
              <textarea name="owner_msg" style="width:100%; height:60px; resize: none;" data-validation-required-message="Please enter a message"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="image"></label>
            <div class="col-sm-10">
              <input type="file" name="lost_image" id="image" class="image_inp" onchange="loadFile(event)" onclick="document.getElementById('upload').style.display='none'" required data-validation-required-message="Please enter the image of the item.">
              <label for="image" class="btn btn-secondary"><p style="color: red; display:inline-block">*</p>Upload Item Lost</label>
              <p style="color: red;" id="upload">pls make sure you upload a picture</p>
              <img id="output" width="100" height="100" style="top: 0px!important; position: inherit!important;" >
            </div>
          </div>
          <button type="submit" class="btn btn-primary" id="sendMessageButton" name="submit">Report</button></a>
        </form>
      </div>
    </div>
  </div>
  <script type="text/javascript">
  
  var loadFile = function(event){
    var image = document.getElementById('output');
    image.src = URL.createObjectURL(event.target.files[0]);
  };
</script>
<?php include('includes/footer.php'); ?>  