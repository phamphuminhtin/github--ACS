<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_GET['id'];
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
    if (isset($_FILES['image'])) {
        $file = $_FILES['image'];
        $file_name = $file['name'];
        move_uploaded_file($file['tmp_name'],'uploads/' .$file_name);
        // if ($file_name == '') {
        //     $file_name = $thongtinsp['Anhsp'];
        //     move_uploaded_file($file['tmp_name'],'uploads/' .$file_name);
        // }
        // else {
        // if ($file['type'] == 'image/jpeg' || $file['type'] == 'image/jpg' || $file['type'] == 'image/png') {
        // move_uploaded_file($file['tmp_name'],'uploads/' .$file_name);
        //     } else {
        //         echo "Không đúng định dạng!";
        //     }
        // }
    }
$conn= mysqli_connect("localhost", "root", "", "phoneworld");
if ($file_name != '') {
$sql = "UPDATE sanpham set Tensp = '$tensp', Anhsp = '$file_name', Giagocsp = '$giagoc',  Giasp = '$gia', SoLuong = '$soluong', Tinhtrang = '$tinhtrang', phukien = '$phukien', baohanh = '$baohanh', Mota = '$mota', IDTH = '$idth', IDDanhMuc = '$iddm' WHERE ID = $id ";
}
else {
    $sql = "UPDATE sanpham set Tensp = '$tensp', Giagocsp = '$giagoc',  Giasp = '$gia', SoLuong = '$soluong', Tinhtrang = '$tinhtrang', phukien = '$phukien', baohanh = '$baohanh', Mota = '$mota', IDTH = '$idth', IDDanhMuc = '$iddm' WHERE ID = $id ";

}
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
    <h2>Sửa sản phẩm</h2>
    <?php 
      $conn3= mysqli_connect("localhost", "root", "", "phoneworld");
      $sql3 = "SELECT * FROM sanpham WHERE id=" .$_GET['id'];
      $kq3 = mysqli_query($conn3, $sql3);
      $thongtinsp = mysqli_fetch_array($kq3);
    ?>
    <form action = "" method="POST" enctype="multipart/form-data">
        <!-- ID sản phẩm: <input type="text" name="ID"><br> -->
        Tên sản phẩm <br>
        <input class="form" type="text" name="tensp" value="<?php echo $thongtinsp['Tensp']; ?>"><br>
        Giá gốc <br>
        <input class="form" type="text" name="giagoc" value="<?php echo $thongtinsp['Giagocsp']; ?>"><br>
        Giá <br>
        <input class="form"type="text" name="gia" value="<?php echo $thongtinsp['Giasp']; ?>"><br>
        Số lượng <br> 
        <input class="form" type="text" name="soluong" value="<?php echo $thongtinsp['SoLuong']; ?>"><br>
        Phụ kiện <br>
        <input class="form" type="text" name="phukien" value="<?php echo $thongtinsp['phukien']; ?>"><br>
        Bảo hành <br>
        <input class="form" type="text" name="baohanh" value="<?php echo $thongtinsp['baohanh']; ?>"><br>
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
        <img width="150px" src="uploads/<?php echo $thongtinsp['Anhsp']; ?>"><br>
        Tình trạng <br>
         <input class="form" type="text" name="tinhtrang" value="<?php echo $thongtinsp['Tinhtrang']; ?>"><br>
        Mô tả <br>
        <textarea rows="10" cols="70" name="mota" value="<?php echo $thongtinsp['Mota']; ?>"></textarea>
        <br>
        <input type="submit" value="Sửa" name="submit" class="submit">
    </form>
    </div>
</body>
</html>
