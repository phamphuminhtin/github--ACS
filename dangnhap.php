<?php
error_reporting(0);
ini_set('display_errors', 0);
session_start();
$message = '';
?>
<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $u = $_POST['username'];
    $p = $_POST['password'];
    $conn= mysqli_connect("localhost", "root", "", "phoneworld");
    $sql = "SELECT * FROM thanhvien WHERE gmail = '".$u."'";
    $kq = mysqli_query($conn, $sql);

    if ($u == '' && $p != '') {
        $message = "<b>Không được để trống tên đăng nhập!</b>";
    } else if ($u != '' && $p == '') {
        $message = "<b>Không được để trống mật khẩu!</b>";
    } else if ($u == '' && $p == '') {
        $message = "<b>Không được để trống tên đăng nhập và mật khẩu!</b>"; 
    } else if ($u != '' && $p != '') {
        if (preg_match('/^\\w+\\d+@{1}gmail.com$/', $u) == false) {
            $message = "<b>Vui lòng nhập đúng định dạng email!!!</b>";
        } else {
            $row = mysqli_fetch_array($kq);
            if ($kq->num_rows === 1) {
                if ($u == $row["gmail"] && $p == $row["matkhau"] && $row["quyentruycap"] == 1) {
                    $user = [$row["IDThanhvien"], $row["hoten"], $row["gmail"], $row["sdt"], $row["quyentruycap"]];
                    $_SESSION['User']=$user;
                    // header("Location: Trangchuql.php"); 
                    header("Location: sanpham.php"); 
                    exit(); 
                } else if($u == $row["gmail"] && $p == $row["matkhau"] && $row["quyentruycap"] == 2) {
                    $user = [$row["IDThanhvien"], $row["hoten"], $row["gmail"], $row["sdt"], $row["quyentruycap"]];
                    $_SESSION['User']=$user;
                    header("Location: Trangchu.php"); 
                    exit(); 
                }
            }
            if ($u != $row["gmail"] || $p != $row["matkhau"]) {
                $message = "<b>Sai thông tin đăng nhập!</b>";
            }
            mysqli_close($conn);
        }
    }
}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
<?php include('topnav.php');?>
    <h1 style="text-align: center; margin-top: 3%; margin-bottom: 3%;">Đăng nhập tài khoản</h1>
    <div class="container">
    <form action="" method="POST">
    <p><input class="form" type="text" placeholder="Nhập Email" name="username" required></p>
    <p><input class="form" type="password" placeholder="Nhập mật khẩu" name="password" required></p>
    <p><input type="checkbox" checked="checked" name="remember"> Nhớ mật khẩu
    <span class="psw"><a href="doimk.php">Đổi mật khẩu</a></span></p>
    <button class="login" type="submit">Đăng Nhập</button>
    </form>
    </div>
    <div style="text-align: center ; color: red;">
    <?php echo $message; ?>
    </div> 
</body>
</html>