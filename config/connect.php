<?php
if(!defined("SECURITY")){
    die("Bạn không có quyền truy cập vào file này!");
}
// $conn = mysqli_connect("localhost", "root", "", "vietpro_mobile_shop");
$conn = mysqli_connect("mysql_db", "root", "root", "vietpro_mobile_shop");
if($conn){
    mysqli_query($conn, "SET NAMEs 'utf8'");
}else{
    echo "Kết nối thất bại!";
}
