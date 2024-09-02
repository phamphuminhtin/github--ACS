<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_GET['iddm'];
    $tendanhmuc = $_POST['tendanhmuc'];
$conn= mysqli_connect("localhost", "root", "", "phoneworld");
$sql = "UPDATE danhmuc set tendanhmuc = '$tendanhmuc' WHERE IDDM = $id ";
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
    <title></title>
</head>
<body>
    <?php include("menu.php") ?>
    <div class="main">
    <h2>Sửa danh mục</h2>
    <form action = "" method="POST" enctype="multipart/form-data">
    <?php 
      $conn1= mysqli_connect("localhost", "root", "", "phoneworld");
      $sql1 = "SELECT * FROM danhmuc WHERE IDDM=" .$_GET['iddm'];
      $kq = mysqli_query($conn1, $sql1);
      $thongtindm = mysqli_fetch_array($kq);
    ?>
<form action = "" method="POST">
        <!-- ID sản phẩm: <input type="text" name="ID"><br> -->
        Tên danh mục<br>
        <input type="text" name="tendanhmuc" class="form" style="margin: 1% 0;" value="<?php echo $thongtindm['tendanhmuc']; ?>"><br>
        <input type="submit" class="submit" value="Sửa">
</form>
</body>
</html>