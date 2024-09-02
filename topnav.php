<?php 
session_start(); 
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
<body>
<header>
<?php 
$conn= mysqli_connect("localhost", "root", "", "phoneworld");
$_SESSION['IDDM'] = $_GET['iddm'];
$sql = "SELECT * FROM danhmuc";
$kq = mysqli_query($conn, $sql);
?>
    <div class="topnav">
        <a href="Trangchu.php" class="thuonghieu">&ensp;PHONE WORLD</a>
        <div><form action="Trangchu.php" method="POST">
     <input  id="search" type="text" class="search" onkeyup=" " placeholder="Bạn cần tìm điện thoại gì.....?"  name="keyword" autocomplete="off" maxlength="100"></input>
        <button><i class="fa fa-search" aria-hidden="true"></i></button> 
        </form>
        </div>
        <div class="dropdown">
        <a href="#"><i class="fa fa-list-alt" style="font-size: 20px;" aria-hidden="true"></i><br></i>DANH MỤC</a>
        <div class="dropdown-content">
        <?php while($row=mysqli_fetch_array($kq)) {
       echo '<a href="Trangchu.php?iddm='.$row["IDDM"].'"><i class="'.$row["icon"].'" style="font-size: 20px;" aria-hidden="true">&nbsp;</i>'.$row["tendanhmuc"].'</a><br>';
        } ?>
        </div>
        </div>
        <div class="dropdown">
        <?php 
        if (isset($_SESSION['User'])) {
            $user = $_SESSION['User'];
            $id = $user[0];
            $hoten = $user[1];
            $gmail = $user[2];
            $sdt = $user[3];
            $quyentruycap = $user[4];
          ?>
        <a id="user" href="#" class="dropbtn" onclick="myFunction()"><i class="fa fa-user" style="font-size: 20px;" aria-hidden="true"></i><br></i><?php echo $hoten; ?></a>
        <div id="myDropdown" class="dropdown-content-click">
        <a href="dangxuat.php"><i class="fa fa-reply" style="font-size: 20px;" aria-hidden="true">&nbsp;</i>Đăng xuất</a><br>
        <?php } else {
        ?>
        <a id="user" href="#" class="dropbtn" onclick="myFunction()"><i class="fa fa-user" style="font-size: 20px;" aria-hidden="true"></i><br></i>TÀI KHOẢN</a>
        <div id="myDropdown" class="dropdown-content-click">
        <a href="dangnhap.php"><i class="fa fa-sign-in" style="font-size: 20px;" aria-hidden="true">&nbsp;</i>Đăng nhập</a><br>
        <a href="dangky.php"><i class="fa fa-plus-square-o" style="font-size: 20px;" aria-hidden="true">&nbsp;</i>Đăng ký</a><br>
        </div>
        <?php } ?>
        </div>
        <?php 
        if (isset($_SESSION['User'])) {
            $user = $_SESSION['User'];
            $id = $user[0];
            $hoten = $user[1];
            $gmail = $user[2];
            $sdt = $user[3];
            $quyentruycap = $user[4];
          ?>
        <a href="donhang.php"><i class="fa fa-gift" style="font-size: 21px;" aria-hidden="true"></i><br></i>ĐƠN HÀNG</a>
        <?php } else {
        ?>
         <a href="#" onclick="document.getElementById('id01').style.display='block'"><i class="fa fa-gift" style="font-size: 21px;" aria-hidden="true"></i><br></i>ĐƠN HÀNG</a>
         <div id="id01" class="modal">
  <div class="modal-content1">
    <div class="containermodal">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      <h2 style="color: black;">Bạn chưa đăng nhập</h2>
      <p>Hãy đăng nhập để có thể xem được đơn hàng</p>
      <hr>
      <div class="clearfix">
      <a href="dangky.php" class="cancelbtn">Đăng ký</a>
      <a href="dangnhap.php" class="signupbtn">Đăng nhập</a>
      </div>
    </div>
  </div>
</div>
        <?php } ?>
        <a href="cart.php"><i class="fa fa-shopping-cart" style="font-size: 20px;" aria-hidden="true"></i><span class="shopping"><?php if(isset($_SESSION['quantity'])) echo $_SESSION['quantity']; else echo 0; ?></span><br>GIỎ HÀNG</a>
        </div>  
        </header>
        <script src="js.js"></script>
        <div style="display: inline;">
        <div id="slide">
            <img src="http://andylongstore.com/storage/banner.jpg" id="hinh">
            <div class="dieuhuong">
                <i class="fa fa-chevron-circle-left" onclick="prev()"></i>
                <i class="fa fa-chevron-circle-right" onclick="next()"></i>
            </div> 
        </div> 
        <div id="slideleft">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR0BGXmvQx9nqdwZXaz-CXDWVwJEIDsBbfDgQ&usqp=CAU" id="hinh">
        </div> 
        <div id="slideright">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR0BGXmvQx9nqdwZXaz-CXDWVwJEIDsBbfDgQ&usqp=CAU" id="hinh">
        </div> 
        </div>
</body>
</html>