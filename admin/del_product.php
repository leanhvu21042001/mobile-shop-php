<?php 
$prd_id = $_GET['prd_id'];
session_start();
define("SECURITY",true);
include_once("../config/connect.php");
if(isset($_SESSION['mail'])&&isset($_SESSION['pass'])){

    mysqli_query($conn,"DELETE FROM product WHERE prd_id = $prd_id");
    header("location: index.php?page_layout=product");
}else{
    header("location: index.php");
}
?>