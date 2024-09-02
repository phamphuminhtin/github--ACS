<?php session_start(); ?>
<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$tendanhmuc = $_POST['tendanhmuc'];
$conn= mysqli_connect("localhost", "root", "", "phoneworld");
$sql = "INSERT INTO danhmuc (tendanhmuc) VALUES ('$tendanhmuc')";
$kq = mysqli_query($conn, $sql);
header("Location: danhmuc.php");
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
<h2>Thêm danh mục</h2>
<form action = "" method="POST">
        Tên danh mục <br>
        <input class="form" type="text" name="tendanhmuc"><br>
        <br>
        <input type="submit" value="Thêm" name="submit" class="submit">
    </form>
</div>
</body>
</html>