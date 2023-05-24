<?php include('includes/header.php');

 // Sending/inserting messages to user area group chat
 if($_POST['street_msg'] != ""){ 
  $raw_msg    =   cleandata($_POST['street_msg']);
  $c_msg      =   sanitize($raw_msg); 
if ($c_msg != "") {
 $db->query('INSERT INTO street_chat (str_name, area_name, lga_name, user_id, user_name, user_msg, user_img, time) VALUES (:name_str, :name_area, :name_lga, :id_user, :name_user, :message, :image, NOW())');
    $db->bindValue(':name_str', $my_street, PDO::PARAM_STR);
    $db->bindValue(':name_area', $my_area, PDO::PARAM_STR);
    $db->bindValue(':name_lga', $my_lga, PDO::PARAM_STR);
    $db->bindValue(':id_user', $my_id, PDO::PARAM_INT);
    $db->bindValue(':name_user', $my_name, PDO::PARAM_STR);
    $db->bindValue(':message', $c_msg, PDO::PARAM_STR);
    $db->bindValue(':image', $my_img, PDO::PARAM_STR);
    $run = $db->execute();
  }
  if ($run) {
    echo "Message Sent Pls Scroll Down For New Msg";
  }
  else{
    echo "Not Sent";
  }
}else{
  echo "No Message type";
}
?>