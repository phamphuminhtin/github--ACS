<?php session_start(); ?>
<?php error_reporting(0);
ini_set('display_errors', 0); ?>
<?php 
$conn= mysqli_connect("localhost", "root", "", "phoneworld");
$_SESSION['IDTH'] = $_GET['idth'];
$_SESSION['IDDM'] = $_GET['iddm'];
$keyword = $_POST['keyword'];
$sql1 = "SELECT * FROM sanpham";
$kq1 = $kq = mysqli_query($conn, $sql1);
$total = mysqli_num_rows($kq1);
$limit = 5;
$page = ceil($total/$limit);
$cr_page = (isset($_GET['page']) ? $_GET['page'] : 1);
$start = ($cr_page - 1)*$limit;
if (isset($_SESSION['IDDM'])) {
  $total = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM sanpham WHERE IDDanhMuc = " . $_SESSION['IDDM']));
  $page = ceil($total/$limit);
  $sql = "SELECT * FROM sanpham WHERE IDDanhMuc = " . $_SESSION['IDDM'] . " LIMIT $start, $limit";
} else if (isset($_SESSION['IDTH'])) {
  $total = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM sanpham WHERE IDTH = " . $_SESSION['IDTH']));
  $page = ceil($total/$limit);
  $sql = "SELECT * FROM sanpham WHERE IDTH = " . $_SESSION['IDTH'] . " LIMIT $start, $limit";
}
else if (isset($_POST['keyword']) && !empty($_POST['keyword'])) {
  $total = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM sanpham WHERE Tensp LIKE '%$keyword%' OR Giasp LIKE '%$keyword%'"));
  $page = ceil($total/$limit);
  $sql = "SELECT * FROM sanpham where Tensp LIKE '%$keyword%' OR Giasp LIKE '%$keyword%' LIMIT $start, $limit";
}
else {
$sql = "SELECT * FROM sanpham LIMIT $start,$limit";
}
$kq = mysqli_query($conn, $sql);

?>
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
<?php include('menu.php');?>
<body style="background-color: whitesmoke;">
<div class="main">
<h2>Quản lý sản phẩm</h2>
<br>
<span>
<div class="search">
  <form action="sanpham.php" method="POST">
  <button><i class="fa fa-search" aria-hidden="true"></i></button> 
     <input  id="search" type="text" class="search" onkeyup=" " placeholder="Bạn cần tìm sản phẩm gì.....?"  name="keyword" autocomplete="off" maxlength="100"></input>
        </form>
      </div>
<div class="butadd">
<a href="themsp.php">Thêm sản phẩm mới</a>
</div>
</span>
<br>
<?php include('menu.php');?>
    <table>
        <tr>
        <th style="border-left: 1px solid gray;">ID</th>
        <th>Tên sản phẩm</th>
        <th>Ảnh</th>
        <th>Giá</th>
        <th>Số lượng</th>
        <th>ID thương hiệu</th>
        <th>ID danh mục</th>
        <th>Sửa sản phẩm</th>
        <th>Xóa sản phẩm</th>
        <th>Thông tin chi tiết</th>
        </tr>
        <?php
         while($row=mysqli_fetch_array($kq)) {
            
            echo '<tr>';
            echo '<td style="border-left: 1px solid gray;">'.$row["ID"].'</td>';
            echo '<td>'.$row["Tensp"].'</td>';
            echo "<td><img src='uploads/".$row["Anhsp"]."' width='100'>" . "</td>";
            echo '<td>'.number_format($row["Giasp"],0, ',', '.').'</td>';
            echo '<td>'.$row["SoLuong"].'</td>';
            echo '<td>'.$row["IDTH"].'</td>';
            echo '<td>'.$row["IDDanhMuc"].'</td>';
            echo '<td> <a href = "suasp.php?id='.$row["ID"].'"><i class="fa fa-pencil" style="font-size: 20px; color:#222222" aria-hidden="true"></i></a></td>';
            echo '<td> <a href = "xoasp.php?id='.$row["ID"].'"><i class="fa fa-trash" style="font-size: 20px; color:#222222"aria-hidden="true"></i></a></td>';
            switch ($row["IDDanhMuc"]) {
              case '1':
                $sql2 = "SELECT * FROM ttchitietlaptop where ID =" .$row["ID"];
                break;
              
              case '2':
                $sql2 = "SELECT * FROM ttchitietdt where ID =" .$row["ID"];
                  break;
              case '3':
                $sql2 = "SELECT * FROM ttchitietmtbang where ID =" .$row["ID"];
                    break;
            }
            // $sql2 = "SELECT * FROM ttchitietlaptop where ID =" .$row["ID"];
            $kq2 = mysqli_query($conn, $sql2);
            $result = mysqli_fetch_array($kq2);
            if (isset($result["ID"])) {
              echo '<td> <a href = "suattchitiet.php?id='.$row["ID"].'&iddm='.$row["IDDanhMuc"].'"><i class="fa fa-pencil" style="font-size: 20px; color:#222222" aria-hidden="true"></i></a></td>';
          } else {
              echo '<td> <a href = "themttchitiet.php?id='.$row["ID"].'&iddm='.$row["IDDanhMuc"].'"><i class="fa fa-plus" style="font-size: 20px; color:#222222" aria-hidden="true"></i></a></td>';
          }
            echo '</tr>';
         }
      
         mysqli_close($conn);
         
        ?>
    </table>
    <nav aria-label="Page navigation example" class="pagination">
      <ul class="pagination pagination-sm">
        <?php if (isset($_SESSION['IDDM'])) { ?>
        <li class="page-item"><a class="page-link" href="sanpham.php?iddm=<?php echo $_SESSION['IDDM'] ?>&page=<?php if ($cr_page - 1 > 0) { echo $cr_page - 1; } else { echo 1;} ?>"><span aria-hidden="true">Previous</span></a></li>
        <?php } else if (isset($_SESSION['IDTH'])) { ?>
        <li class="page-item"><a class="page-link" href="sanpham.php?idth=<?php echo $_SESSION['IDTH'] ?>&page=<?php if ($cr_page - 1 > 0) { echo $cr_page - 1; } else { echo 1;} ?>"><span aria-hidden="true">Previous</span></a></li>
        <?php  } else if (isset($_POST['keyword']) && !empty($_POST['keyword'])) { ?>
        <li class="page-item"><a class="page-link" href="sanpham.php?keyword=<?php echo $keyword ?>&page=<?php if ($cr_page - 1 > 0) { echo $cr_page - 1; } else { echo 1;} ?>"><span aria-hidden="true">Previous</span></a></li>
        <?php  } else { ?> 
        <li class="page-item">
        <a class="page-link" href="sanpham.php?page=<?php  if ($cr_page - 1 > 0) { echo $cr_page - 1; } else { echo 1;}?>" aria-label="<<">
        <span aria-hidden="true">Previous</span>
        </a>
        </li>
        <?php   } ?>
        <?php
        for ($i=1; $i<=$page; $i++) {?>
          <?php if (isset($_SESSION['IDDM'])) { ?>
            <li class="page-item <?php echo (($cr_page == $i)? 'active' :'') ?>"><a class="page-link" href="sanpham.php?iddm=<?php echo $_SESSION['IDDM'] ?>&page=<?php echo $i ?>"><?php echo $i ?></a></li>
          <?php } else if (isset($_SESSION['IDTH'])) { ?>
            <li class="page-item <?php echo (($cr_page == $i)? 'active' :'') ?>"><a class="page-link" href="sanpham.php?idth=<?php echo $_SESSION['IDTH'] ?>&page=<?php echo $i ?>"><?php echo $i ?></a></li>
          <?php } else if (isset($_POST['keyword']) && !empty($_POST['keyword'])) { ?>
            <li class="page-item <?php echo (($cr_page == $i)? 'active' :'') ?>"><a class="page-link" href="sanpham.php?keyword=<?php echo $keyword ?>&page=<?php echo $i ?>"><?php echo $i ?></a></li>
          <?php } else { ?> 
            <li class="page-item <?php echo (($cr_page == $i)? 'active' :'') ?>"><a class="page-link" href="sanpham.php?page=<?php echo $i ?>"><?php echo $i ?></a></li>
            <?php } ?>    
          <?php } ?>
          <?php if (isset($_SESSION['IDDM'])) { ?>
            <li class="page-item"><a class="page-link" href="sanpham.php?iddm=<?php echo $_SESSION['IDDM'] ?>&page=<?php if ($cr_page < $page) { echo $cr_page + 1; } else { echo $page;} ?>"><span aria-hidden="true">Next</span></a></li>
          <?php } else if (isset($_SESSION['IDTH'])) { ?>
            <li class="page-item"><a class="page-link" href="sanpham.php?idth=<?php echo $_SESSION['IDTH'] ?>&page=<?php if ($cr_page < $page) { echo $cr_page + 1; } else { echo $page;} ?>"><span aria-hidden="true">Next</span></a></li>
          <?php }  else if (isset($_POST['keyword']) && !empty($_POST['keyword'])) { ?>
            <li class="page-item"><a class="page-link" href="sanpham.php?keyword=<?php echo $keyword ?>&page=<?php if ($cr_page < $page) { echo $cr_page + 1; } else { echo $page;} ?>"><span aria-hidden="true">Next</span></a></li>
        <?php  } else  { ?> 
          <li class="page-item">
          <a class="page-link" href="sanpham.php?page=<?php if ($cr_page < $page) { echo $cr_page + 1; } else { echo $page;} ?>" aria-label=">>">
            <span aria-hidden="true">Next</span>
          </a>
        </li>
        <?php } ?>   
       
      </ul>
    </nav>
</div>
</body>
</html>
