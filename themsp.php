<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // $ID = $_POST['ID'];
    $tensp = $_POST['tensp'];
    $soluong = $_POST['soluong'];
    $giagoc = $_POST['giagoc'];
    $tinhtrang = $_POST['tinhtrang'];
    $gia = $_POST['gia'];
    $mota = $_POST['mota'];
    $iddm = $_POST['iddanhmuc']; 
    $idth = $_POST['idthuonghieu']; 
    $phukien = $_POST['phukien'];
    $baohanh = $_POST['baohanh'];
    $conn= mysqli_connect("localhost", "root", "", "phoneworld");
    if (isset($_FILES['image'])) {
        $file = $_FILES['image'];
        $file_name = $file['name'];
        move_uploaded_file($file['tmp_name'],'uploads/' .$file_name);

    }
$sql = "INSERT INTO sanpham (Tensp, Anhsp, Giagocsp, Giasp, SoLuong, phukien, baohanh, Tinhtrang, Mota, IDTH, IDDanhMuc) VALUES ('$tensp','$file_name',$giagoc,  $gia, $soluong ,'$phukien', '$baohanh', '$tinhtrang', '$mota', $idth, $iddm)";
$kq = mysqli_query($conn, $sql);
header("Location: sanpham.php");
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
    <h2>Thêm sản phẩm</h2>
    <form action = "" method="POST" enctype="multipart/form-data">
        <!-- ID sản phẩm: <input type="text" name="ID"><br> -->
        Tên sản phẩm <br>
        <input class="form" type="text" name="tensp"><br>
        Giá gốc <br>
        <input class="form" type="text" name="giagoc"><br>
        Giá <br>
        <input class="form"type="text" name="gia"><br>
        Số lượng <br> 
        <input class="form" type="text" name="soluong"><br>
        Phụ kiện <br>
        <input class="form" type="text" name="phukien"><br>
        Bảo hành <br>
        <input class="form" type="text" name="baohanh"><br>
        Thương hiệu<br>
        <select name="idthuonghieu" class="form">
            <?php
            $conn1= mysqli_connect("localhost", "root", "", "phoneworld");
            $sql1 = "SELECT * FROM thuonghieu";
            $kq = mysqli_query($conn1, $sql1);
            while ($row = mysqli_fetch_array($kq))
            {
                echo '<option value="'.$row['IDTH'].'">'.$row['tenthuonghieu'].'</option>';
            }
            ?>
        </select><br>
        Danh mục<br>
        <select name="iddanhmuc" class="form">
            <?php
            $conn2= mysqli_connect("localhost", "root", "", "phoneworld");
            $sql2 = "SELECT * FROM danhmuc";
            $kq = mysqli_query($conn2, $sql2);
            while ($row = mysqli_fetch_array($kq))
            {
                echo '<option value="'.$row['IDDM'].'">'.$row['tendanhmuc'].'</option>';
            }
            ?>
        </select>
        <br>
        Ảnh sản phẩm <br>
        <input class="form" type="file" name="image"><br>
        Tình trạng <br>
         <input class="form" type="text" name="tinhtrang"><br>
        Mô tả <br>
        <textarea rows="10" cols="70" name="mota"></textarea>
        <br>
        <input type="submit" value="Thêm" name="submit" class="submit">
    </form>
    </div>
</body>
</html>
