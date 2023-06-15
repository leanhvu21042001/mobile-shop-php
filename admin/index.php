<?php

session_start();
define("SECURITY", True);
include_once("../config/connect.php");

if(isset($_SESSION['mail']) && isset($_SESSION['pass'])){
    echo "admin page";
    include_once("admin.php");
}else{
    include_once("login.php");
}
?>