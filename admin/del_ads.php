<?php 
$ads_id = $_GET['ads_id'];
session_start();
define("SECURITY",true);
include_once("../config/connect.php");
if(isset($_SESSION['mail'])&&isset($_SESSION['pass'])){

    mysqli_query($conn,"DELETE FROM ads WHERE ads_id = $ads_id");
    header("location: index.php?page_layout=ads");
}else{
    header("location: index.php");
}
?>