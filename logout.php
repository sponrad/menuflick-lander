<?php
//logout - clear session redirect to index

session_start();

session_unset();

header("Location: http://www.menuflick.com");

?>