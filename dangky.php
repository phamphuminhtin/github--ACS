<?php error_reporting(0);
ini_set('display_errors', 0); 
session_start();
$_SESSION['scrollPosition'] = $_SERVER['REQUEST_URI'];
$message = '';
?>
<?php 
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $sdt = $_POST['sdt'];
    $password = $_POST['psw'];
    $repassword = $_POST['repsw'];
    $conn= mysqli_connect("localhost", "root", "", "phoneworld");
    $sql1 = "SELECT * FROM thanhvien WHERE gmail = '$email'";
    $kq1 = mysqli_query($conn, $sql1);
    $sql2 = "SELECT * FROM thanhvien WHERE sdt = '$sdt'";
    $kq2 = mysqli_query($conn, $sql2);
    if ($name == '' || $email == '' || $sdt == '' || $password == '' || $repassword == '') {
        $message = '<b style="text-align: center;">Không được để trống thông tin!</b>';
        }
    else if  ($name != '' && $email != '' && $sdt != '' && $password != '' && $repassword != '') {
         if (preg_match('/^\\w+\\d+@{1}gmail.com+$/', $email) == false) { 
            $message = '<b>Email không đúng định dạng!</b>';
            }
         else if (preg_match('/^0[0-9]{9}+$/', $sdt) == false) { 
            $message = '<b>Số điện thoại phải có 10 chữ số và chữ số đầu tiên là 0 !</b>';
                }
        else if ($password != $repassword) { 
            $message = '<b>Mật khẩu nhập lại không khớp !</b>';
                    }
                else {
                    if (mysqli_num_rows($kq1) > 0 && mysqli_num_rows($kq2) > 0 ) {
                        $message = '<b>Email và số điện thoại đăng ký đã tồn tại!</b>';
                    }
                    else if (mysqli_num_rows($kq1) > 0) {
                        $message = '<b>Email đăng ký đã tồn tại!</b>';
                    }
                    else if (mysqli_num_rows($kq2) > 0) {
                        $message = '<b>Số điện thoại đăng ký đã tồn tại!</b>';
                    }
                        else {
                            $sql = "INSERT INTO thanhvien (hoten, gmail, matkhau, sdt, quyentruycap) VALUES ('$name','$email', '$password' ,'$sdt', 2)";
                            $kq = mysqli_query($conn, $sql);
                            $result = mysqli_query($conn, "SELECT * FROM thanhvien");
                            if ($result) {
                                // Di chuyển con trỏ đến hàng cuối cùng
                                mysqli_data_seek($result, mysqli_num_rows($result) - 1);
                                $row1 = mysqli_fetch_assoc($result);
                                $user = [$row1["IDThanhvien"], $row1["hoten"], $row1["gmail"], $row1["sdt"], $row1["quyentruycap"]];
                                $_SESSION['User']=$user;                            
                                header("Location: Trangchu.php");
                            }
                            mysqli_free_result($result);
                            mysqli_close($conn);
                            exit();
                                }
                }
        }

}
?>
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
<?php include('topnav.php');
$dieuhuong = "#"; ?>
    <h1 style="text-align: center; margin-top: 3%; margin-bottom: 3%; ">Đăng ký tài khoản</h1>
    <div class="container">
    <form action= "" method="POST">
    <p><input class="form" type="text" placeholder="Nhập họ và tên" name="name" required></p>
    <p><input class="form" type="text" placeholder="Nhập số điện thoại" name="sdt" required></p>
    <p><input class="form" type="text" placeholder="Nhập email" name="email" required></p>
    <p><input class="form" type="password" placeholder="Nhập mật khẩu" name="psw" required></p>
    <p><input class="form" type="password" placeholder="Nhập lại mật khẩu" name="repsw" required></p>
    <p><input type="checkbox" checked="checked" name="remember">Tôi đồng ý với các điều khoản bảo mật cá nhân
    <button class="login" type="submit">Đăng ký</button>
    </form>
    </div>
    <div style="text-align: center; color: red;">
    <?php echo $message; ?>
</div>
</body>
</html>