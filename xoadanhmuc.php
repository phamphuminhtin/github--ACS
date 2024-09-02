<?php include('menu.php');?>
<?php 
$id = $_GET['iddm'];
$conn= mysqli_connect("localhost", "root", "", "phoneworld");
$sql = "DELETE FROM danhmuc WHERE IDDM=$id";
$kq = mysqli_query($conn, $sql);
header("Location: danhmuc.php");
?>
