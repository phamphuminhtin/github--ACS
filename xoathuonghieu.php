<?php include('menu.php');?>
<?php 
$id = $_GET['idth'];
$conn= mysqli_connect("localhost", "root", "", "phoneworld");
$sql = "DELETE FROM thuonghieu WHERE IDTH=$id";
$kq = mysqli_query($conn, $sql);
header("Location: thuonghieu.php");
?>
