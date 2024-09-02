<?php include('menu.php');?>
<?php 
$id = $_GET['idtv'];
$conn= mysqli_connect("localhost", "root", "", "phoneworld");
$sql = "DELETE FROM thanhvien WHERE IDThanhvien=$id";
$kq = mysqli_query($conn, $sql);
header("Location: thanhvien.php");
?>
