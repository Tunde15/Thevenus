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
$my_area   =   $_SESSION['user_data']['area'];
$my_lga   =   $_SESSION['user_data']['lga'];
$db->query('CREATE TABLE ' .$my_area.'_of_'.''.$my_lga.'
(
table_id int,
user_id int,
user_name varchar(255),
user_text varchar(255),
user_image varchar(255),
datetime varchar(255)
);');
$create_area_tbl = $db->execute();
if ($create_area_tbl) {
  $db->query('INSERT INTO group_tables (area_tbl, group_creator) VALUES (:areanme, :creatornme)');
  $my_areanew = $my_area .'_of_'.$my_lga ;
  $db->bindValue(':areanme', $my_areanew, PDO::PARAM_STR);
  $db->bindValue(':creatornme', $fullname, PDO::PARAM_STR);
  $area_exec = $db->execute();
}
if ($area_exec) {
  echo '<div class="alert alert-success text-center">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>You have successfully created </strong>' . $my_areanew . ' talks now you can have great conversation with people in your area. 
                </div>';
}
 ?>