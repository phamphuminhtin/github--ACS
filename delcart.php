<?php
session_start();

if (isset($_GET['index']) && isset($_GET['quantity'])) {
  $index = $_GET['index'];
  $quantity = $_GET['quantity'];

  // Cập nhật giá trị mới trong $_SESSION['cart']
  if (isset($_SESSION['cart'][$index])) {
    $_SESSION['cart'][$index]['4'] = $quantity;
    $_SESSION['cart'][$index]['total'] = $quantity * $_SESSION['cart'][$index]['3'];
  }
}
?>