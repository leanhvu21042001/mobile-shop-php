<?php
$user_id = $_GET['user_id'];
session_start();
define("SECURITY",true);
include_once("../config/connect.php");
if(isset($_SESSION['mail'])&&isset($_SESSION['pass'])){
    mysqli_query($conn,"DELETE FROM user WHERE user_id = $user_id");
    header("location: index.php?page_layout=user");
}else{
    header("location: index.php");
}
?>