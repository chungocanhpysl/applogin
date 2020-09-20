<?php
session_start();

if(isset($_SESSION["loggedin"]) && ($_SESSION["loggedin"] == true)) {
    header("Location: index.php");
    exit;
}

//nạp file kết nối csdl
include_once "config.php";

//biến lưu trữ lỗi trong quá trình đăng nhập
$errors = array();

//xử lý đăng nhập
if(isset($_POST) && !empty ($_POST)) {
    if(!isset($_POST["username"]) || empty($_POST["username"])) {
        $errors[] = "chưa nhập username";
    }
    if(!isset($_POST["password"]) ||empty($_POST["password"])) {
        $errors[] = "chưa nhập password";
    }
    //nếu mảng errors bị rỗng tức là k có lỗi
    if(is_array($errors) && empty($errors)) {
        $username = $_POST["username"];
        $password = md5($_POST["password"]);

        $sqlLogin = "select * from users where username= ? and password= ? ";
        //chuẩn bị cho sql
        $stmt = $connection->prepare($sqlLogin);

        //bind biến vào trong câu sql
        $stmt->bind_param("ss",$username,$password);

        //thực thi câu lệnh sql
        $stmt->execute();

        //lấy ra bản ghi
        $res = $stmt->get_result();

        $row = $res->fetch_array(MYSQLI_ASSOC);

        if (isset($row['id']) && ($row['id']>0)) {
            //nếu tồn tại bản ghi thì sẽ tạo ra session đăng nhập
                $_SESSION["loggedin"] = true;
                $_SESSION["username"] = $row["username"];
            header("Location: index.php");
            exit;
        }
        else {
            $errors[] = "dữ liệu đã nhập không đúng";
        }


        }


    }

    if(is_array($errors) && !empty($errors)) {
        $errors_string = implode("<br>", $errors);
        echo "<div class='alert alert-danger'>";
        echo $errors_string;
        echo "</div>";

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
<div class="container" style="margin-top: 150px">
    <div class="row">
        <div class="col-md-12">
            <form name="login" action="" method="post">
                <h1>Đăng nhập</h1>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" name="username" placeholder="Enter username">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password">
                </div>
                <div class="form-group form-check">
                    <p><a href="register.php">Đăng ký</a> </p>
                </div>
                <button type="submit" class="btn btn-primary">Đăng nhập</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>