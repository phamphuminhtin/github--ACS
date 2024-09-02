<?php
// Trang đăng xuất
session_start();

// Xóa thông tin tài khoản khỏi phiên
unset($_SESSION['User']);

// Xóa toàn bộ phiên
session_destroy();

// Chuyển hướng đến trang đăng nhập hoặc trang khác
header("Location: Trangchu.php");
exit;
?>