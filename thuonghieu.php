<?php session_start(); 
error_reporting(0);
ini_set('display_errors', 0);
$keyword = $_POST['keyword']; ?>
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
<div class="main">
<h2>Quản lý thương hiệu</h2>
<span>
<div class="search">
  <form action="thuonghieu.php" method="POST">
  <button><i class="fa fa-search" aria-hidden="true"></i></button> 
     <input  id="search" type="text" class="search" onkeyup=" " placeholder="Bạn cần tìm thương hiệu gì.....?"  name="keyword" autocomplete="off" maxlength="100"></input>
        </form>
      </div>
      <div class="butadd">
<a href="themthuonghieu.php">Thêm thương hiệu mới</a>
</div>
</span>
<?php include('menu.php');?>
    <table class="danhmuc">
        <tr>
        <th style="border-left: 1px solid gray;">ID Thương hiệu</th>
        <th>Tên thương hiệu</th>
        <th>Ảnh</th>
        <th>Sửa thương hiệu</th>
        <th>Xóa thương hiệu</th>
        </tr>
        <?php
         // 1.Kết nối
         $conn= mysqli_connect("localhost", "root", "", "phoneworld");
         // 2.Truy vấn
         if (isset($_POST['keyword']) && !empty($_POST['keyword'])) {
            $sql = "SELECT * FROM thuonghieu where tenthuonghieu LIKE '%$keyword%'";
          }
          else {
         $sql = "SELECT * FROM thuonghieu";
}
         $kq = mysqli_query($conn, $sql);
         while($row=mysqli_fetch_array($kq)) {
        echo '<tr>';
        echo '<td style="border-left: 1px solid gray;">'.$row["IDTH"].'</td>';
        echo '<td> <a href = "sanpham.php?idth='.$row["IDTH"].' ">'.$row["tenthuonghieu"].'</a></td>';
        echo "<td><img src='uploads/".$row["Anhth"]."' width='100'>" . "</td>";
        echo '<td> <a href = "suathuonghieu.php?idth='.$row["IDTH"].'"><i class="fa fa-pencil" style="font-size: 20px; color:#222222"aria-hidden="true"></i></a></td>';
        echo '<td> <a href = "xoathuonghieu.php?idth='.$row["IDTH"].'"><i class="fa fa-trash" style="font-size: 20px; color:#222222"aria-hidden="true"></i></a></td>';
        echo '</tr>';
         }
         mysqli_close($conn);
        ?>
    </table>
</div>
</body>
</html>
