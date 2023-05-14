<?php include('includes/header.php'); ?>
<?php
//Include functions
include('includes/functions.php');
?>
<?php
//require database class files
require('includes/pdocon.php');

//instatiating our database objects
$db = new Pdocon;
 ?>
<?php
 // Sending/inserting messages to user area group chat
  $raw_msg    =   cleandata($_POST['area_msg']);
  $c_msg      =   sanitize($raw_msg); 
if ($c_msg != "") {
 $db->query('INSERT INTO area_chat (area_name, lga_name, user_id, user_name, user_msg, user_img, time) VALUES (:name_area, :name_lga, :id_user, :name_user, :message, :image, NOW())');
    $my_id = $_SESSION['user_data']['id'];
    $full_name = $_SESSION['user_data']['fullname'];
    $db->bindValue(':name_area', $my_area, PDO::PARAM_STR);
    $db->bindValue(':name_lga', $my_lga, PDO::PARAM_STR);
    $db->bindValue(':id_user', $my_id, PDO::PARAM_INT);
    $db->bindValue(':name_user', $full_name, PDO::PARAM_STR);
    $db->bindValue(':message', $c_msg, PDO::PARAM_STR);
    $db->bindValue(':image', $img_sent, PDO::PARAM_STR);
    $run = $db->execute();
  }
  if ($run) {
    echo "Message Sent Pls Scroll Down For New Msg";
  }
  else{
    echo "Not Sent";
  }
?>