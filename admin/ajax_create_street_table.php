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
 //Creating area table
$my_street   =   $_SESSION['user_data']['street'];
$my_area   =   $_SESSION['user_data']['area'];
$db->query('CREATE TABLE ' .$my_street.'_in_'.''.$my_area.'
(
table_id int,
user_id int,
user_name varchar(255),
user_text varchar(255),
user_image varchar(255),
datetime varchar(255)
);');
$create_street_tbl = $db->execute();
if ($create_street_tbl) {
  $db->query('INSERT INTO group_tables (streets_tbl, group_creator) VALUES (:streetnme, :creatornme)');
  $my_streetnew = $my_street .'_in_'.$my_area ;
  $db->bindValue(':streetnme', $my_streetnew, PDO::PARAM_STR);
  $db->bindValue(':creatornme', $fullname, PDO::PARAM_STR);
  $street_exec = $db->execute();
}
if ($street_exec) {
  echo '<div class="alert alert-success text-center">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>You have successfully created </strong>' . $my_streetnew . ' talks now you can have great conversation with people in your area. 
                </div>';
}
 ?>