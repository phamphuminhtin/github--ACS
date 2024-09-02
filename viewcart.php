<?php session_start(); ?>
<?php
$conn= mysqli_connect("localhost", "root", "", "phoneworld");
$sql = "SELECT * FROM sanpham ";
$kq = mysqli_query($conn, $sql);
$cart = (isset($_SESSION['cart']))? $_SESSION['cart'] : [];
$row=mysqli_fetch_array($kq)
// echo "<pre>";
// print_r($cart);
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
<body>
    <div id="mycart" class="cart">
              <section style="margin-top: 5%;">
                  <table style="margin: 0;">
                    <thead>
                    <tr>
                      <th class="SP">Sản phẩm</th>
                      <th>Giá</th>
                      <th>SL</th>
                      <th>Chọn</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cart as $key => $row); 
                    '<tr>';
                    echo "<td><img width='70px' src='uploads/" . $row["Anhsp"] . "'><span class='title'>" . $row["Tensp"] . "</span></td>";
                      echo '<td><span class="gia">'.$row["Giasp"].'<sup>đ</sup></span></td>';
                      '<td><input class="SL" style="width: 50px; outline: none;" type="number" value="1" min="1"></td>';
                      '<td style="cursor: pointer;"><span class="delete">Xóa</span></td>';
                    '</tr>';
                    ?>
                    </tbody>
                  </table>                
                    <!-- <div id="totalprice" class="price-total">
                      <p>Tổng tiền: <span>0</span></p>
                    </div>
                      <div id="oder1" class="Oder">
                        <p>ĐẶT HÀNG</p>
                      </div> -->
              <!-- </section>
              </div>
</body>
</body>
</html>