<?php session_start(); 
error_reporting(0);
ini_set('display_errors', 0);
$keyword = $_POST['keyword'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Document</title>
</head>
<?php include('menu.php');?>
<body style="background-color: whitesmoke;">
<div class="search">
  <form action="" method="POST" style="margin: 25px;">
  <button><i class="fa fa-search" aria-hidden="true"></i></button> 
     <input  id="search" type="text" class="search" onkeyup=" " placeholder="Bạn cần tìm ai.....?"  name="keyword" autocomplete="off" maxlength="100"></input>
        </form>
      </div>
<div class="main">
<h2>Quản lý thành viên</h2>
<?php include('menu.php');?>
    <table class="danhmuc">
        <tr>
        <th style="border-left: 1px solid gray;">ID Thành viên</th>
        <th>Tên người dùng</th>
        <th>GMAIL</th>
        <th>Mật Khẩu</th>
        <th>Số điện thoại</th>
        <th>Quyền truy cập</th>
        <th>Sửa</th>
        <th>Xóa</th>
        </tr>
        <?php
         // 1.Kết nối
         $conn= mysqli_connect("localhost", "root", "", "phoneworld");
         // 2.Truy vấn
         if (isset($_POST['keyword']) && !empty($_POST['keyword'])) {
            $sql = "SELECT * FROM thanhvien where hoten LIKE '%$keyword%' OR gmail LIKE '%$keyword%' OR sdt LIKE '%$keyword%'";
          }
          else {
         $sql = "SELECT * FROM thanhvien";
          }
          $kq = mysqli_query($conn, $sql);
         while($row=mysqli_fetch_array($kq)) {
            echo '<tr>';
            echo '<td style="border-left: 1px solid gray;">'.$row["IDThanhvien"].'</td>';
            echo '<td>'.$row["hoten"].'</td>';
            echo '<td>'.$row["gmail"].'</td>';
            echo '<td>'.$row["matkhau"].'</td>';
            echo '<td>'.$row["sdt"].'</td>';
            if ($row["quyentruycap"]==1) {
            echo '<td>Admin</td>';
        } else {
            echo '<td>Khách hàng</td>';
        }
            echo '<td> <a href = "suathanhvien.php?idtv='.$row["IDThanhvien"].'"><i class="fa fa-pencil" style="font-size: 20px; color:#222222"aria-hidden="true"></i></a></td>';
            echo '<td> <a href = "xoathanhvien.php?idtv='.$row["IDThanhvien"].'"><i class="fa fa-trash" style="font-size: 20px; color:#222222"aria-hidden="true"></i></a></td>';
            echo '</tr>';
         }
         mysqli_close($conn);
        ?>
    </table>
</div>
</body>
</html>
