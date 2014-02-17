<?php 
// just a redirect file
//receive parameters, set session variables, redirect to feed
session_start();

$_SESSION["authToken"] = $_GET["authToken"];
$_SESSION["userId"] = $_GET["userId"];

header("Location: http://www.menuflick.com/feed");

?>
