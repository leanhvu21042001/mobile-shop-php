<?php
$cat_id = $_GET['cat_id'];
session_start();
define("SECURITY",true);
include_once("../config/connect.php");
if(isset($_SESSION['mail'])&&isset($_SESSION['pass'])){
    mysqli_query($conn,"DELETE FROM category WHERE cat_id = $cat_id");
    header("location: index.php?page_layout=category");
}else{
    header("location: index.php");
}
?>