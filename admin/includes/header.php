<?php 
//Open ob_start and session_start functions
    ob_start();
require('includes/init.php');
$session = new Session();

if($session->checksignin() == false){
  header("Location: logout.php");
}else{
  date_default_timezone_set("UTC");   
}
?>
<!DOCTYPE html>
  <html lang="en">
  <head>     
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="People, community" />
  <meta name="description" content="" />
  <meta name="keywords" content="photos & people; logos business cards, search, logos, personal cards, custom cards, Motivation, people in my area" />
  <meta property="og:title" content="community; personal Cards | Grassroot" />
  <meta property="og:type" content="website" />
  <meta property="og:url" content="https://www.theveenuus.com.ng" />
  <meta property="og:image" content="" />
  <meta property="og:site_name" content="theveenuus | thevenus" />
  <meta itemprop="name" content="People & community; personal Cards | Welfarism Helps togetherness" />
  <meta itemprop="description" content="" />
  <meta itemprop="image" content="" />

        <title>The Venus</title>
        <!-- Bootstrap CSS -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link rel="stylesheet" type="text/css" href="changecss/Thevenus.css">
        <link rel="icon" type="image/x-icon" href="image/venus.jpeg">

        <!-- Custom Fonts -->
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        <!-- script jquery -->
        <script src="js/jquery.js"></script>
        <script src="js/scripts.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    </head>
    <body>          
     <!-- Navigation -->
  <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <?php if(isset($_SESSION['id'])){
                $user         = new User();
                $result       = $user->find_byid($_SESSION['id']);
                $my_name      = $result->user_name;
                $my_id      = $result->user_id;
                $my_area      = $result->user_area;
                $my_street    = $result->user_street;
                $my_lga       = $result->user_lga;
                $my_img      = $result->user_img;
                
                $image        =   "<img src='uploaded_image/$result->user_img' height='40px!important;' width='40px!important;' style='position:static!important;' />";
                }else{
                  redirect('logout.php');
                } 
                ?>
      <a class="navbar-brand" href="../index.php">The Venus</a>
      <div style="margin-left: 20px;">
      <a class="str_talk text-white" href="#">Street <i class='fa fa-comment'></i></a>
    </div>
      <div style="margin-left: 10px;">
      <a class="area_talk text-white" href="#">Area <i class='fa fa-comment'></i></a>
      </div>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="user_page.php"><?php echo $image ?> 
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="user_page.php"><?php echo $result->user_name; ?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../blog.php">Blog</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php"><i class="fa fa-sign-out"></i>LogOut</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>       
    <div class="container">
        <br><br>
        <script> showAreStrBox(); </script>
    