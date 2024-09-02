<?php 
error_reporting(0);
ini_set('display_errors', 0);
$iddh = $_GET['iddh'];
$quyentruycap = $_GET['quyentruycap'];
$conn= mysqli_connect("localhost", "root", "", "phoneworld");
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
<?php 
    if ($quyentruycap == 1) {
    include('menu.php');
    $sql = "SELECT * FROM chitietdonhang WHERE iddh = " .$iddh;
    $kq = mysqli_query($conn, $sql);
    $style = "main";
} else if ($quyentruycap == 2) {
    // include('topnav.php');
    $sql = "SELECT * FROM chitietdonhang WHERE iddh = " .$iddh;
$kq = mysqli_query($conn, $sql);
}
?>
<body>
<div class="main">
    <table class="danhmuc">
        <tr>
        <th style="border-left: 1px solid gray;">ID sản phẩm</th>
        <th>Tên sản phẩm</th>
        <th>Ảnh</th>
        <th>Đơn giá</th>
        <th>Số lượng</th>
        </tr>
        <?php
         while($row=mysqli_fetch_array($kq)) {
            echo '<tr>';
            echo '<td style="border-left: 1px solid gray;">'.$row["idpro"].'</td>';
            echo '<td>'.$row["Tensp"].'</td>';
            echo "<td><img src='uploads/".$row["img"]."' width='100'>" . "</td>";
            echo '<td>'.$row["dongia"].'</td>';
            echo '<td>'.$row["soluong"].'</td>';
            echo '</tr>';
        }
         mysqli_close($conn);
        ?>
    </table>
</div>
</body>
</html>