<?php 
session_start(); 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id=$_POST['id'];
    $iduser = $_POST['iduser'];
    $quyentruycap = $_POST['quyentruycap'];
    $tennguoinhan = $_POST['name'];
    $sdtnguoinhan = $_POST['sdt'];
    $diachi = $_POST['diachi'];
    $ptthanhtoan = $_POST['ptthanhtoan'];
    $email = $_POST['email'];
    $tongtien = $_POST['tongtien'];
    $conn= mysqli_connect("localhost", "root", "", "phoneworld");

$sql = "INSERT INTO donhang (IDUSER, Ten, sdt, gmail, diachi, ptthanhtoan, tongtien, Trangthai) VALUES ('$iduser','$tennguoinhan',$sdtnguoinhan,'$email', '$diachi', '$ptthanhtoan', '$tongtien', 'Chưa xử lý')";
$kq = mysqli_query($conn, $sql);
$iddh = mysqli_insert_id($conn);
$uniqueCart = array_unique($_SESSION['cart'], SORT_REGULAR);
    foreach ($uniqueCart as $key => $value) {
        if ($value[0]>0 && !empty($value[1]) && !empty($value[2]) && $value[3]>0 && $value[4]>0 ) {
            $idpro = $value[0];
            $img = $value[1];
            $Tensp = $value[2];
            $dongia = $value[3];
            $soluong = $value[4];
            $soluongkho = $value[5];
        $sql1 = "INSERT INTO chitietdonhang (Iduser, ten, iddh, idpro, img, Tensp, dongia, soluong) VALUES ('$iduser','$tennguoinhan','$iddh', '$idpro', '$img', '$Tensp', '$dongia', '$soluong')";
        $kq1 = mysqli_query($conn, $sql1);
        $sql2 = "UPDATE sanpham SET SoLuong = " . ($soluongkho - $soluong) . " WHERE ID = " . $idpro;
        echo $sql2;
        $kq2 = mysqli_query($conn, $sql2);
        }
    }
mysqli_close($conn);
header("Location: donhang.php"); 
}
?>
