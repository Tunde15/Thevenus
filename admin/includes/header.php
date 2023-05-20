<?php 
//Open ob_start and session_start functions
    ob_start();
    session_start();

?>

<?php 

if(isset($_SESSION['user_is_logged_in'])){
    date_default_timezone_set("UTC");
    
}else{
    
    header("Location: logout.php");
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
  <meta name="keywords" content="found an item; lost an item" />
  <meta property="og:title" content="community; street and area news | Grassroot" />
  <meta property="og:type" content="website" />
  <meta property="og:url" content="https://www.theveenuus.com.ng" />
  <meta property="og:image" content="" />
  <meta property="og:site_name" content="theveenuus.com.ng | my area" />
  <meta itemprop="name" content="People & community; area street | Welfarism Helps togetherness" />
  <meta itemprop="description" content="" />
  <meta itemprop="image" content="" />


        <title>The Veenuus | Be the change and connect to your community</title>

        <!-- Bootstrap CSS -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link rel="stylesheet" type="text/css" href="changecss/Thevenus.css">
        <link rel="icon" type="image/x-icon" href="image/arealogo.png">

        <!-- Custom Fonts -->
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        
        <!-- script jquery -->
        <script src="js/jquery.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>

        

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]
        url(https://lh3.googleusercontent.com/-7kOBhr3B2dE/AAAAAAAAAAI/AAAAAAAAAAA/AOtt-yHs4g14qqNJaJBXAcpIMv_fV9dDGw/s32-c-mo/photo.jpg)
        -->
    </head>
    
    <body> 

<script>
  $(document).ready(function(){
    $('.area_talk').click(function(){
   $('#area_conv').show();
    });

    $('.str_talk').click(function(){
   $('#street_conv').show();
    });
    $('.close1').click(function(){
      $('#area_conv').hide();
    })
    $('.close2').click(function(){
      $('#street_conv').hide();
    })
    
  });

</script>          
     <!-- Navigation -->
  <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <?php if(isset($_SESSION['user_is_logged_in'])){
    
                 $fullname  =   $_SESSION['user_data']['fullname'];
                 $my_street =   $_SESSION['user_data']['street'];
                 $my_area   =   $_SESSION['user_data']['area'];
                 $my_lga    =   $_SESSION['user_data']['lga'];
                 $image     =   $_SESSION['user_data']['image'];
                 $img_sent  =   $_SESSION['user_data']['imgsent'];  
                 $my_id     =   $_SESSION['user_data']['id'];
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
            <a class="nav-link" href="user_page.php"><?php echo $fullname ?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="area_blog.php">Area News</a>
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
    