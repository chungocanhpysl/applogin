<?php
//khsi báo các hằng số dùng để kết nối đến csdl

define("DB_SERVER","localhost");
define("DB_SERVER_USERNAME","root");
define("DB_SERVER_PASSWORD","");
define("DB_SERVER_NAME","applogin");

$connection = mysqli_connect(DB_SERVER,DB_SERVER_USERNAME,DB_SERVER_PASSWORD,DB_SERVER_NAME);

//kiểm tra xem kết nối có thành công không
//nếu không thành công thì ngắt ctr bằng die()

if($connection==false) {
    die("không thể kết nối đến cơ sở dữ liệu" . mysqli_connect_error());
}
else {
    echo "kết nối thành công";
}