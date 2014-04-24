<?php session_start(); ?>
<?php 
if ( isset($_SESSION['authToken']) && isset($_SESSION['userId']) ) { 
  $userId = $_SESSION['userId'];
  $authToken = $_SESSION['authToken'];
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Menuflick</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/styles.css" rel="stylesheet" media="screen">
    <script src="https://code.jquery.com/jquery.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <script src="js/functions.js"></script>

  </head>
  <body id="top" class="<?= basename($_SERVER['PHP_SELF'], ".php")?>">
    <?php if ( isset($_SESSION['authToken']) && isset($_SESSION['userId']) ) { ?>
    <button id="logoutLink" onlcick="location.href='http://www.menuflick.com/logout'">Logout</button>
    <button id="feedButton" onclick="location.href='http://www.menuflick.com/feed'">Feed</button>
    <button id="menuButton" onclick="location.href='http://www.menuflick.com/restaurants'">Menu</button>
    <button id="menuButton" onclick="location.href='http://www.menuflick.com/profile?profileid=<?= $userId; ?>'">Profile</button>
    <?php } ?>

