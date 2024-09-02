<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_GET['idth'];
    $tenthuonghieu = $_POST['tenthuonghieu'];
    $iddm = $_POST['iddanhmuc']; 
    if (isset($_FILES['image'])) {
        $file = $_FILES['image'];
        $file_name = $file['name'];
        move_uploaded_file($file['tmp_name'],'uploads/' .$file_name);
        if (empty($file_name)) {
            $file_name = $thongtinsp['image'];
            move_uploaded_file($file['tmp_name'],'uploads/' .$file_name);
        }
        else {
        if ($file['type'] == 'image/jpeg' || $file['type'] == 'image/jpg' || $file['type'] == 'image/png') {
        move_uploaded_file($file['tmp_name'],'uploads/' .$file_name);
            } else {
                echo "Không đúng định dạng!";
            }
        }
    }
$conn= mysqli_connect("localhost", "root", "", "phoneworld");
$sql = "UPDATE thuonghieu set tenthuonghieu = '$tenthuonghieu' , Anhth = '$file_name' , IDDanhMuc = '$iddm' WHERE IDTH = $id ";
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
    <title></title>
</head>
<body>
    <?php include("menu.php") ?>
    <div class="main">
    <h2>Sửa thương hiệu</h2>
    <form action = "" method="POST" enctype="multipart/form-data">
    <?php 
      $conn1= mysqli_connect("localhost", "root", "", "phoneworld");
      $sql1 = "SELECT * FROM thuonghieu WHERE IDTH=" .$_GET['idth'];
      $kq = mysqli_query($conn1, $sql1);
      $thongtinth = mysqli_fetch_array($kq);
    ?>
<form action = "" method="POST" enctype="multipart/form-data">
        <!-- ID sản phẩm: <input type="text" name="ID"><br> -->
        Tên thương hiệu<br>
        <input type="text" name="tenthuonghieu" class="form" style="margin: 1% 0;" value="<?php echo $thongtinth['tenthuonghieu']; ?>"><br>
        Ảnh thương hiệu<br>
        <input class="form" type="file" name="image"><br>
        <img width="150px" src="uploads/<?php echo $thongtinsp['Anhsp']; ?>"><br>
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
        <input type="submit" class="submit" value="Sửa">
</form>
</body>
</html>