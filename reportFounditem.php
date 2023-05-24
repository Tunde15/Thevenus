<?php include('includes/reportitemheader.php');

if(isset($_POST['submit'])){
    
    $raw_name           =   cleandata($_POST['item_name']);
    $raw_foundat        =   cleandata($_POST['found_at']);
    $raw_contact        =   cleandata($_POST['founder_contact']);
    $raw_foundername    =   cleandata($_POST['founder_name']);
    $raw_foundermsg     =   cleandata($_POST['founder_msg']);

    
    $c_name             =   sanitize($raw_name);
    $c_foundat          =   sanitize($raw_foundat);
    $c_contact          =   sanitize($raw_contact);
    $c_foundername      =   sanitize($raw_foundername);
    $c_foundermsg       =   sanitize($raw_foundermsg);

    //Collect Front-Image
    $item_pic              =   $_FILES['lost_image']['name'];
    $item_pic_tmp          =   $_FILES['lost_image']['tmp_name'];
    // Collecting info to send to the mail
    // $to = "tundeajayi@ymail.com";
    // $email_subject = "Found Item Report";
    // $email_body = "item picture: $item_pic \n item name: $c_name \n found at: $c_foundat \n founder contact: $c_contact \n founder name: $c_foundername \n founder msg: $c_foundermsg";
    // mail($to, $email_subject, $email_body);
    
    //move image to permanent location
    move_uploaded_file($item_pic_tmp, "admin/uploaded_image/$item_pic");

    
    $db->query('INSERT INTO found_items (id, item_name, found_at, founder_contact, founder_name, founder_msg, date, image) VALUES (NULL, :itemname, :itemfound, :itemcontact, :foundername, :foundermsg, NOW(), :image) ');

    $db->bindValue(':itemname', $c_name, PDO::PARAM_STR);
    $db->bindValue(':itemfound', $c_foundat, PDO::PARAM_STR);
    $db->bindValue(':itemcontact', $c_contact, PDO::PARAM_STR);
    $db->bindValue(':foundername', $c_foundername, PDO::PARAM_STR);
    $db->bindValue(':foundermsg', $c_foundermsg, PDO::PARAM_STR);
    $db->bindValue(':image', $item_pic, PDO::PARAM_STR);

    $run = $db->execute();
    
    if($run){
      redirect('foundit.php');

      keepmsg('<div class="alert alert-success text-center">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success!</strong>You have report an item and it will be shown through all our platform to find the owner.
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
         <h3>Report An Item Found</h3>
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
              <label><p style="color: red; display:inline-block">*</p>Found At:</label>
              <input type="text" class="form-control" id="name" name="found_at"  required data-validation-required-message="Please enter location of where you found the item." placeholder="Location of where you found the item">
              <p class="help-block"></p>
            </div>
          </div>
          <div class="control-group form-group">
            <div class="controls">
              <label><p style="color: red; display:inline-block">*</p>Founder Contact:</label>
              <input type="text" class="form-control" id="name" name="founder_contact"  required data-validation-required-message="Please enter the contact where the owner can reach you." placeholder="Contact where the owner can reach you">
              <p class="help-block"></p>
            </div>
          </div>
          <div class="control-group form-group">
            <div class="controls">
              <label><p style="color: red; display:inline-block">*</p>First Name:</label>
              <input type="text" class="form-control" id="name" name="founder_name"  data-validation-required-message="Please enter your first name." placeholder="Only Your First Name">
              <p class="help-block"></p>
            </div>
          </div>
          <div class="control-group form-group">
            <div class="controls">
            <label><p style="color: red; display:inline-block">*</p>Your Message:</label>
              <textarea name="founder_msg" style="width:100%; height:60px; resize: none;" data-validation-required-message="Please enter a message"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="image"></label>
            <div class="col-sm-10">
              <input type="file" name="lost_image" id="image" class="image_inp" onchange="loadFile(event)" onclick="document.getElementById('upload').style.display='none'" required data-validation-required-message="Please enter the image of the item.">
              <label for="image" class="btn btn-secondary"><p style="color: red; display:inline-block">*</p>Upload Item Found</label>
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