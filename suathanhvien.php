<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$id = $_GET['idtv'];
$tennguoidung = $_POST['tennguoidung'];
$email = $_POST['email'];
$matkhau = $_POST['matkhau'];
$sdt = $_POST['sdt'];
$conn= mysqli_connect("localhost", "root", "", "phoneworld");
$sql = "UPDATE thanhvien set hoten = '$tennguoidung', gmail = '$email', matkhau = '$matkhau',  sdt = '$sdt' WHERE IDThanhvien = $id ";
$kq = mysqli_query($conn, $sql);
header("Location: thanhvien.php");
mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title></title>
</head>
<body>
    <?php include("menu.php") ?>
    <div class="main">
    <h2>Sửa thành viên</h2>
    <form action = "" method="POST" enctype="multipart/form-data">
    <?php 
      $conn1= mysqli_connect("localhost", "root", "", "phoneworld");
      $sql1 = "SELECT * FROM thanhvien WHERE IDThanhvien=" .$_GET['idtv'];
      $kq1 = mysqli_query($conn1, $sql1);
      $thongtintv = mysqli_fetch_array($kq1);
    ?>
<form action = "" method="POST">
        <!-- ID sản phẩm: <input type="text" name="ID"><br> -->
        Tên người dùng<br>
        <input type="text" name="tennguoidung" class="form" style="margin: 1% 0;" value="<?php echo $thongtintv['hoten']; ?>"><br>
        Gmail<br>
        <input type="text" name="email" class="form" style="margin: 1% 0;" value="<?php echo $thongtintv['gmail']; ?>"><br>
        Mật khẩu<br>
        <input type="text" name="matkhau" class="form" style="margin: 1% 0;" value="<?php echo $thongtintv['matkhau']; ?>"><br>
        Số điện thoại<br>
        <input type="text" name="sdt" class="form" style="margin: 1% 0;" value="<?php echo $thongtintv['sdt']; ?>"><br>
        <input type="submit" class="submit" value="Sửa">
</form>
</body>
</html>