<?php session_start(); ?>
<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$tenthuonghieu = $_POST['tenthuonghieu'];
$iddm = $_POST['iddanhmuc']; 
if (isset($_FILES['image'])) {
    $file = $_FILES['image'];
    $file_name = $file['name'];
    move_uploaded_file($file['tmp_name'],'uploads/' .$file_name);
}
$conn= mysqli_connect("localhost", "root", "", "phoneworld");
$sql = "INSERT INTO thuonghieu (tenthuonghieu, Anhth) VALUES ('$tenthuonghieu', '$file_name')";
$kq = mysqli_query($conn, $sql);
header("Location: thuonghieu.php");
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
    <title>Document</title>
</head>
<?php include('menu.php');?>
<body style="background-color: whitesmoke;">
<div class="main">
<h2>Thêm thương hiệu</h2>
<form action = "" method="POST" enctype="multipart/form-data">
        Tên thương hiệu <br>
        <input class="form" type="text" name="tenthuonghieu"><br>
        <br>
        Ảnh thương hiệu <br>
        <input class="form" type="file" name="image"><br>
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
        <br><br>
        <input type="submit" value="Thêm" name="submit" class="submit">
    </form>
</div>
</body>
</html>