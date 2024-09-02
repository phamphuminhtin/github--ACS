<?php include('menu.php');?>
<?php 
$id = $_GET['id'];
$conn= mysqli_connect("localhost", "root", "", "phoneworld");
$sql = "DELETE FROM blsanpham WHERE ID=$id";
$kq = mysqli_query($conn, $sql);
header("Location: binhluan.php");
?>
