<?php session_start(); ?>
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

  </head>
  <body id="top">
    <div id="accountDiv" style="float: left;">
      <?php if ( isset($_SESSION['authToken']) && isset($_SESSION['userId']) ) { ?>
	<a href="/logout" id="logoutLink">Logout</a>
      <?php } else { ?>
	<a href="/login" id="loginLink">Login</a>
	<div id="loginDiv" style="display: none; float: left;">
	  <form id="loginForm">
	    <input type="text" name="username" placeholder="username" />
	    <input type="password" name="password" placeholder="password" />
	    <input type="submit" id="loginButton" value="Login" />
	  </form>
	</div>
      <?php } ?>
    </div>
    
