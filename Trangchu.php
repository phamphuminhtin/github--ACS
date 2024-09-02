<?php session_start(); ?>
<?php error_reporting(0);
ini_set('display_errors', 0); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap-5.3.2-dist/css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap-5.3.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/mystyle.css">
    <title>Document</title>
</head>
<body>
<script src="js.js"></script>
<?php include('topnav.php');?>
<?php 
$conn= mysqli_connect("localhost", "root", "", "phoneworld");
$_SESSION['IDTH'] = $_GET['idth'];
$_SESSION['IDDM'] = $_GET['iddm'];
$keyword = $_POST['keyword'];
$sql1 = "SELECT * FROM sanpham";
$kq1 = $kq = mysqli_query($conn, $sql1);
$total = mysqli_num_rows($kq1);
$limit = 15;
$page = ceil($total/$limit);
$cr_page = (isset($_GET['page']) ? $_GET['page'] : 1);
$start = ($cr_page - 1)*$limit;
$residual = $total - 15*($page-1);
if (isset($_SESSION['IDDM'])) {
  switch ($_SESSION['IDDM']) {
    case '1':
      include('laptop.php');
      break;
    
      case '2':
        include('dienthoai.php');
        break;
  }
   $total = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM sanpham WHERE IDDanhMuc = " . $_SESSION['IDDM']));
   $page = ceil($total/$limit);
   $residual = $total - 15*($page-1);
   $sql = "SELECT * FROM sanpham WHERE IDDanhMuc = " . $_SESSION['IDDM'] . " LIMIT $start, $limit";
} else if (isset($_SESSION['IDTH'])) {
  $total = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM sanpham WHERE IDTH = " . $_SESSION['IDTH']));
  $page = ceil($total/$limit);
  $residual = $total - 15*($page-1);
  $sql = "SELECT * FROM sanpham WHERE IDTH = " . $_SESSION['IDTH'] . " LIMIT $start, $limit";
}
else if (isset($_POST['keyword']) && !empty($_POST['keyword'])) {
  $sql = "SELECT * FROM sanpham where Tensp LIKE '%$keyword%' OR Giasp LIKE '%$keyword%' LIMIT $start, $limit";
}
else {
  $sql = "SELECT * FROM sanpham LIMIT $start,$limit";
}
$kq = mysqli_query($conn, $sql);
?>
<?php
 if (mysqli_num_rows($kq) > 0) {
 echo '<div class="product-grid">';
while($row=mysqli_fetch_array($kq)) {
    echo '<div class="item">';
    echo '<a href = "chitietsp.php?id='.$row["ID"].'&iddm='.$row["IDDanhMuc"].'">';
       echo "<img src='uploads/".$row["Anhsp"]."'>";
       echo '<h3>'.$row["Tensp"].'</h3>';
       echo '<span class="gia">'.number_format($row["Giasp"],0, ',', '.').'<sup>đ</sup></span>';
       echo '<span class="giaphu">'.number_format($row["Giagocsp"],0, ',', '.').'<sup>đ</sup></span>';
       if($row["SoLuong"]>0) {
       echo '<form action="cart.php" method="post">';
       echo '  <input type="number" style="display: none;" name="soluong" min="1" value="1">';
       echo '  <input type="hidden" name="tensp" value="'.$row["Tensp"].'">';
       echo '  <input type="hidden" name="idsp" value="'.$row["ID"].'">';
       echo '  <input type="hidden" name="gia" value="'.$row["Giasp"].'">';
       echo '  <input type="hidden" name="hinh" value="'.$row["Anhsp"].'">';
       echo '  <input type="hidden" name="slkho" value="'.$row["SoLuong"].'">';
       echo '  <button type="submit" name="addcart" class="addcart">Thêm vào giỏ hàng &nbsp;<i class="fa fa-shopping-cart" aria-hidden="true"></i></button>';
       echo '</form>';   
      }
      else {
        echo '  <button class="addcart">Hết hàng &nbsp;</button>';
      }   
       echo '</a>';
       echo '</div>';
  } 
  echo '</div>';
}
else {
  echo "<h1 style='text-align: center; margin: 5%'>Không có sản phẩm mà bạn tìm kiếm</h1>";
}
 mysqli_close($conn);
?>
  <?php 
   $top = 1175;
  if ($cr_page == $page) {
  if ($residual<=5) {
    $top = 385;
  }
  else if ($residual>5&&$residual<=10) {
    $top = 785;
  } else if ($residual>10&&$residual<=15) {
    $top = 1175;
  }
}
  ?>
  <div class="paginations" style="top:<?php echo $top; ?>px;">
  <nav aria-label="Page navigation example" class="pagination">
      <ul class="pagination pagination-sm">
        <?php if (isset($_SESSION['IDDM'])) { ?>
        <li class="page-item"><a class="page-link" href="Trangchu.php?iddm=<?php echo $_SESSION['IDDM'] ?>&page=<?php if ($cr_page - 1 > 0) { echo $cr_page - 1; } else { echo 1;} ?>"><span aria-hidden="true">Previous</span></a></li>
        <?php } else if (isset($_SESSION['IDTH'])) { ?>
        <li class="page-item"><a class="page-link" href="Trangchu.php?idth=<?php echo $_SESSION['IDTH'] ?>&page=<?php if ($cr_page - 1 > 0) { echo $cr_page - 1; } else { echo 1;} ?>"><span aria-hidden="true">Previous</span></a></li>
        <?php } else  { ?> 
        <li class="page-item">
        <a class="page-link" href="Trangchu.php?page=<?php  if ($cr_page - 1 > 0) { echo $cr_page - 1; } else { echo 1;}?>" aria-label="<<">
        <span aria-hidden="true">Previous</span>
        </a>
        </li>
        <?php   } ?>
        <?php
        for ($i=1; $i<=$page; $i++) {?>
          <?php if (isset($_SESSION['IDDM'])) { ?>
            <li class="page-item <?php echo (($cr_page == $i)? 'active' :'') ?>"><a class="page-link" href="Trangchu.php?iddm=<?php echo $_SESSION['IDDM'] ?>&page=<?php echo $i ?>"><?php echo $i ?></a></li>
          <?php } else if (isset($_SESSION['IDTH'])) { ?>
            <li class="page-item <?php echo (($cr_page == $i)? 'active' :'') ?>"><a class="page-link" href="Trangchu.php?idth=<?php echo $_SESSION['IDTH'] ?>&page=<?php echo $i ?>"><?php echo $i ?></a></li>
          <?php } else  { ?> 
            <li class="page-item <?php echo (($cr_page == $i)? 'active' :'') ?>"><a class="page-link" href="Trangchu.php?page=<?php echo $i ?>"><?php echo $i ?></a></li>
            <?php } ?>    
          <?php } ?>
          <?php if (isset($_SESSION['IDDM'])) { ?>
            <li class="page-item"><a class="page-link" href="Trangchu.php?iddm=<?php echo $_SESSION['IDDM'] ?>&page=<?php if ($cr_page < $page) { echo $cr_page + 1; } else { echo $page;} ?>"><span aria-hidden="true">Next</span></a></li>
          <?php } else if (isset($_SESSION['IDTH'])) { ?>
            <li class="page-item"><a class="page-link" href="Trangchu.php?idth=<?php echo $_SESSION['IDTH'] ?>&page=<?php if ($cr_page < $page) { echo $cr_page + 1; } else { echo $page;} ?>"><span aria-hidden="true">Next</span></a></li>
          <?php } else  { ?> 
          <li class="page-item">
          <a class="page-link" href="Trangchu.php?page=<?php if ($cr_page < $page) { echo $cr_page + 1; } else { echo $page;} ?>" aria-label=">>">
            <span aria-hidden="true">Next</span>
          </a>
        </li>
        <?php } ?>   
      </ul>
    </nav>
    </div>
</body>
</html>