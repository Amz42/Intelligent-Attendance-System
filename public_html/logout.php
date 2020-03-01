<?php

session_start();
$_SESSION['loggedin']=false;
$_SESSION = array();
session_unset();
session_destroy();
header("location: login.php");

?>