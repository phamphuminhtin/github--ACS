<?php 
session_start(); 
    if (isset($_POST['send'])) {
        $iddm = $_POST['iddm'];
        $id = $_POST['id'];
        $user = $_SESSION['User'];
        $iduser = $user[0];
        $ten = $user[1];
        $gmail = $user[2];
        $quyentruycap = $user[4];
        $noidungbl = $_POST['noidungbl'];
        $conn= mysqli_connect("localhost", "root", "", "phoneworld");
        if ($noidungbl!="") {
        $sql = "INSERT INTO blsanpham (id_sp, Iduser, ten, gmail, noidungbl) VALUES ('$id','$iduser','$ten', '$gmail', '$noidungbl')";
        $kq = mysqli_query($conn, $sql);
        mysqli_close($conn); }
        header("Location: chitietsp.php?id=". $id ."&iddm=".$iddm); 
        }
?>