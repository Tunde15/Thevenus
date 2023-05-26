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
  <meta name="author" content="People, community, lost and found item" />
  <meta name="description" content="" />
  <meta name="keywords" content="photos & people; logos, search for people, personal cards, street blogs and news, area blogs and news, Motivation, people in my area" />
  <meta property="og:title" content="community; street and area news | Grassroot" />
  <meta property="og:type" content="website" />
  <meta property="og:url" content="https://www.theveenuus.com.ng" />
  <meta property="og:image" content="" />
  <meta property="og:site_name" content="theveenuus.com.ng | my area" />
  <meta itemprop="name" content="People & community; area street | Welfarism Helps togetherness" />
  <meta itemprop="description" content="" />
  <meta itemprop="image" content="" />


        <title>The Veenuus</title>

        <!-- Bootstrap CSS -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link rel="stylesheet" type="text/css" href="changecss/Thevenus.css">
        <link rel="icon" type="image/x-icon" href="image/arealogo.png">

        <!-- Custom Fonts -->
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">     
        <!-- script jquery -->
        <script src="js/jquery.js"></script>
        <script src="js/scripts.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    </head>
    
    <body> 
         <script>
  $(document).ready(function(){
    $('.area_talk').click(function(){
   $('#area_conv').show();
    });
    $('.close1').click(function(){
      $('#area_conv').hide();
    })
    
  });

</script> 
     <!-- Navigation -->
  <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
    <?php if(isset($_SESSION['id'])){
                $admin         = new Admin();
                $result       = $admin->find_byid($_SESSION['id']);
                $my_name      = $result->admin_name;
                $my_id        = $result->admin_id;
                $my_area      = $result->admin_area;
                $my_lga       = $result->admin_lga;
                $my_img       = $result->admin_img;
                
                $image        =   "<img src='uploaded_image/$result->admin_img' height='40px!important;' width='40px!important;' style='position:static!important;' />";
                }else{
                  redirect('logout.php');
                } 
                ?>
      <a class="navbar-brand" href="../index.php">The Venus</a>
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
            <a class="nav-link" href="user_page.php"><?php echo $my_name ?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../blog.php">Blog</a>
          </li>
          <!-- <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPortfolio" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Talks
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPortfolio">
              <a class="dropdown-item str_talk" href="#">Street Talk</a>
              <a class="dropdown-item area_talk" href="#">Area Talk</a>
            </div>
          </li> -->
          <li class="nav-item">
            <a class="nav-link" href="logout.php"><i class="fa fa-sign-out"></i>LogOut</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
        
    <div class="container">
        <br><br>
    