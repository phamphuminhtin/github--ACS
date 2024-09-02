<?php session_start(); 
error_reporting(0);
ini_set('display_errors', 0);?>
<?php
if(!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
  if (isset($_GET['delid']) && $_GET['delid'] >= 0) {
    $delid = $_GET['delid'];
    if (isset($_SESSION['cart'][$delid])) {
        unset($_SESSION['cart'][$delid]); // Xóa sản phẩm khỏi giỏ hàng
        $_SESSION['cart'] = array_values($_SESSION['cart']); // Sắp xếp lại mảng giỏ hàng
    }
}
if (isset($_GET['increase']) && is_numeric($_GET['increase'])) {
  $increaseIndex = $_GET['increase'];
  if (isset($_SESSION['cart'][$increaseIndex])) {
      if ($_SESSION['cart'][$increaseIndex][4]>=$_SESSION['cart'][$increaseIndex][5]) {
       ?><script> alert("Số lượng đã đạt mức tối đa.");</script><?php 
      } else{
      $_SESSION['cart'][$increaseIndex][4]++;
    }
  }
}

if (isset($_GET['decrease']) && is_numeric($_GET['decrease'])) {
  $decreaseIndex = $_GET['decrease'];
  if (isset($_SESSION['cart'][$decreaseIndex])) {
      if ($_SESSION['cart'][$decreaseIndex][4] > 1) {
          $_SESSION['cart'][$decreaseIndex][4]--;
      }
  }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$id = $_POST['idsp'];
$hinh = $_POST['hinh'];
$tensp = $_POST['tensp'];
$gia = $_POST['gia'];
$soluongkho = $_POST['slkho'];
$soluong = 1;
$count=0;
for ($i=0; $i < sizeof($_SESSION['cart']); $i++) {
  if ($_SESSION['cart'][$i][2]==$tensp) {
    $count=1;
    if ($_SESSION['cart'][$i][4]<$_SESSION['cart'][$i][5]) {
      $soluongnew = $soluong + $_SESSION['cart'][$i][4] ;
      $_SESSION['cart'][$i][4] = $soluongnew;
    } 
    break;
  } 
}
}
if ($count==0 && $soluongkho>0) {
  $sp = [$id, $hinh, $tensp, $gia, $soluong, $soluongkho];
  $_SESSION['cart'][]=$sp;
}
$tong=0;
$_SESSION['quantity']=0;
function showcart() {
if (isset($_SESSION['cart'])&&(is_array($_SESSION['cart']))) {
global $tong;
for($i=0; $i < sizeof($_SESSION['cart']); $i++) {
  $_SESSION['quantity']++;
  $tt = $_SESSION['cart'][$i][3]*$_SESSION['cart'][$i][4];
  $tong += $tt;
if (!isset($_SESSION['cart'][$i][0])) {
  $_SESSION['quantity']--;
    continue; // Bỏ qua và không hiển thị hàng đã bị xóa
}
else {
   echo '<tr>
  <td>'.$_SESSION['cart'][$i][0].'</td>
  <td><img src="uploads/'.$_SESSION['cart'][$i][1].'" style="width: 70px;"></td>
  <td>'.$_SESSION['cart'][$i][2].'</td>
  <td>'.number_format($_SESSION['cart'][$i][3],0, ',', '.').'</td>
  <td colspan="5" style="width: 100px;"><button class = "quantity"><a href="cart.php?decrease='.$i.'"><i class="fa fa-minus" style="font-size: 12px; color:#222222" aria-hidden="true"></i></a></button>
  <span class = "SL">'.$_SESSION['cart'][$i][4].'</span>
  <button class = "quantity"><a href="cart.php?increase='.$i.'"><i class="fa fa-plus" style="font-size: 12px; color:#222222" aria-hidden="true"></i></a></button></td>
  <td><span class = "delete"><a href="cart.php?delid='.$i.'"><i class="fa fa-trash" style="font-size: 30px; color:#222222"aria-hidden="true"></i></a></span></td>
  </tr>';
}
}
}
}

?>
<script src="js.js"></script>
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
  <a href="Trangchu.php" style="float: right;"><i class="fa fa-reply-all" style="font-size: 35px; color:#222222; margin: 15px;" aria-hidden="true"></i></a>
              <section style="margin-top: 5%;">
                  <table style="margin: 0;">
                    <thead>
                    <tr>
                    <th>ID</th>
                    <th>Ảnh sản phẩm</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th colspan="5" style="width: 100px;">SL</th>
                    <th>Xóa</th>
                    </tr>
                    </thead>
                    <tbody>
                  <?php
    if (count($_SESSION['cart']) > 0) { 
    showcart(); }?>
    </tbody>
    </table>
    <footer>         
    <div id="totalprice" class="price-total">
    <p>Tổng tiền: <span><?php echo number_format($tong,0, ',', '.'); ?> VND</span></p>
    </div>  
    <button class="Oder" type="submit" onclick="document.getElementById('id01').style.display='block'">
      <p>ĐẶT HÀNG</p>
    </button> 
    <?php 
     if ($_SESSION['quantity']==0) {
      ?> 
        <div id="id01" class="modal">
  <div class="modal-content">
    <div class="containermodal">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      <h2>Bạn chưa có sản phẩm nào trong giỏ hàng</h2>
      <p>Hãy thêm sản phẩm vào để có thể đặt hàng</p>
      <hr>
    </div>
  </div>
</div>
   <?php  } else {
        if (!isset($_SESSION['User'])) {
          ?>
    <div id="id01" class="modal">
  <div class="modal-content1">
    <div class="containermodal">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      <h2>Bạn chưa đăng nhập</h2>
      <p>Hãy đăng nhập để có thể đặt hàng</p>
      <hr>
      <div class="clearfix">
      <a href="dangky.php"><button class="cancelbtn">Đăng ký</button></a>
      <a href="dangnhap.php"><button class="signupbtn">Đăng nhập</button></a>
      </div>
    </div>
  </div>
</div>
<?php } else if (isset($_SESSION['User'])) { 
              $user = $_SESSION['User'];
              $iduser = $user[0];
              $hoten = $user[1];
              $gmail = $user[2];
              $sdt = $user[3];
              $quyentruycap = $user[4];
  ?> 
<div id="id01" class="modal">
  <form class="modal-content" method="POST" action="dathang.php">
    <div class="containermodal">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      <h1>ĐẶT HÀNG</h1>
      <p>Vui lòng điền đầy đủ thông tin </p>
      <hr class="hr">
      
      <label for="name"><b>Họ và tên người nhận</b></label>
      <input type="text" placeholder="Nhập họ và tên" name="name" value="<?php echo $hoten; ?>" required>

      <label for="sdt"><b>Số điện thoại người nhận</b></label>
      <input type="text" placeholder="Nhập số điện thoại" name="sdt" value="<?php echo $sdt; ?>" required>
      
      <label for="email"><b>Email người nhận</b></label>
      <input type="text" placeholder="Nhập email" name="email" value="<?php echo $gmail; ?>" required>
      
      <label for="sdt"><b>Địa chỉ nhận hàng</b></label>
      <input type="text" placeholder="Nhập địa chỉ" name="diachi" required>
      <h3>Phương thức thanh toán</h3>
      <input type="radio" id="tructiep" name="ptthanhtoan" value="Thanh toán khi nhận hàng">
      <label for="tructiep">Thanh toán khi nhận hàng</label><br>
      <input type="radio" id="chuyenkhoan" name="ptthanhtoan" value="Thanh toán bằng chuyển khoản">
      <label for="chuyenkhoan">Thanh toán chuyển khoản</label><br>
      <input type="radio" id="vidientu" name="ptthanhtoan" value="Thanh toán bằng ví điện tử">
      <label for="vidientu">Thanh toán bằng ví điện tử</label><br><br>
      <input type="hidden" name="id" value="<?php echo $id; ?>" >
      <input type="hidden" name="iduser" value="<?php echo $iduser; ?>" >
      <input type="hidden" name="tongtien" value="<?php echo $tong; ?>" >
      <input type="hidden" name="quyentruycap" value="<?php echo $quyentruycap; ?>" >
      <input type="submit" value="Gửi" name="submit" style="width: 100px !important;" class="submit">
    </div>
  </form>
</div>  
<?php } } ?>
</footer>   
</section> 
</div> 
</body>
</html>