<?php
//để sử dụng tính năng login, khởi động session trong php

session_start();

//kiểm tra người dùng đã đăng nhập chưa
//nếu chưa đăng nhập thì chuyển hướng về trang login.php
if(!isset($_SESSION["loggedin"]) || ($_SESSION["loggedin"] != true))  {
    //chuyển hướng redirect trong php sử dụng hàm header
    header("Location: login.php");
    exit;
}

echo "<pre>";
print_r($_SESSION);
echo "</pre>";



//nếu đã đăng nhập thành công

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Đăng nhập thành công</h1>
            <p>Tên người dùng: <?php echo $_SESSION["username"] ?></p>
            <p><a href="logout.php">Đăng xuất</a></p>
        </div>
    </div>
</div>
</body>
</html>