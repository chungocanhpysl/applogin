<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>

<?php
include_once "config.php";

if(isset($_POST) && !empty($_POST)) {
    //tạo mảng lưu trữ lỗi
    $errors = array();

    if(!isset($_POST["username"]) || empty($_POST["username"])) {
        $errors[] = "username không hợp lệ";
    }
    if(!isset($_POST["password"]) || empty($_POST["password"])) {
        $errors[] = "password không hợp lệ";
    }
    if(!isset($_POST["cf_password"]) || empty($_POST["cf_password"])) {
        $errors[] = "cf_password không hợp lệ";
    }

    if($_POST["cf_password"] != $_POST["password"]) {
        $errors[] = "confirm password khác password";
    }

    if(empty($errors)) {
        //nếu không có lỗi thì thực thi câu lệnh insert vào csdl
        $username = $_POST["username"];
        $password = md5($_POST["password"]);
        $created_at = date("Y-m-d H:i:s");

        $sqlInsert = "insert into users (username,password,created_at) values (?,?,?)";

        //chuẩn bị cho sql
        $stmt = $connection->prepare($sqlInsert);

        //bind 3 biến vào trong ssql
        $stmt->bind_param("sss", $username, $password, $created_at);
        $stmt->execute();
        $stmt->close();

        echo "<div class='alert alert-succes'>";
        echo "đăng ký người dùng mới thành công. <a href='login.php'>Login</a>";
        echo "</div>";
    } else {
        $errors_string = implode("<br>", $errors);
        echo "<div class='alert alert-danger'>";
        echo $errors_string;
        echo "</div>";
    }
}

?>
<div class="container" style="margin-top: 150px">
    <div class="row">
        <div class="col-md-12">
            <form name="register" action="" method="post">
                <h1>Đăng ký người dùng</h1>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" name="username" placeholder="Enter username">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password">
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" class="form-control" name="cf_password" placeholder="Confirm Password">
                </div>



                <button type="submit" class="btn btn-primary">Đăng ký</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>