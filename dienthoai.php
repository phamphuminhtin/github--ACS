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
    <div class="block-filter-brands">
<div class="brands__content" style="text-align: center;">
    <div class="list-brand" >
    <?php
      $conn= mysqli_connect("localhost", "root", "", "phoneworld");
      $sql = "SELECT * FROM thuonghieu";
      $kq = mysqli_query($conn, $sql); 
      while($row=mysqli_fetch_array($kq)) {
    if($row["IDDanhMuc"]==2) {
    echo '<a href = "Trangchu.php?idth='.$row["IDTH"].' " target="_self" class="list-brand__item">';
    echo "<img src='uploads/" . $row["Anhth"] . "' class='filter-brand__img'>";
    echo '</a>';
    }
      }
    ?>
    </div>
</div>
</div>
</body>
</html>