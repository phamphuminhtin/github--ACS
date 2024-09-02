<?php 
session_start(); 
error_reporting(0);
ini_set('display_errors', 0);
$iduser = $_SESSION['User'][0];
$quyentruycap = $_SESSION['User'][4];
$keyword = $_POST['keyword'];
$conn= mysqli_connect("localhost", "root", "", "phoneworld");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
if (isset($_POST['sub'])) {
$id = $_GET['id'];
$trangthai = $_POST['trangthai'];
$sql = "UPDATE donhang set Trangthai = '$trangthai' WHERE ID = $id ";
$kq = mysqli_query($conn, $sql);
}
}
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
</head>
<body>

<?php 
    if ($quyentruycap==1) {
        include('menu.php');
        if (isset($_POST['keyword']) && !empty($_POST['keyword'])) {
            $sql2 = "SELECT * FROM donhang where Ten LIKE '%$keyword%' OR gmail LIKE '%$keyword%' OR sdt LIKE '%$keyword%' OR tongtien LIKE '%$keyword%' OR Ngaydathang LIKE '%$keyword%'";
          }
          else {
        $sql2 = "SELECT * FROM donhang";
    }
        $kq2 = mysqli_query($conn, $sql2);
        ?>
        <span>
<div class="search">
  <form action="" method="POST">
  <button><i class="fa fa-search" aria-hidden="true"></i></button> 
     <input  id="search" type="text" class="search" onkeyup=" " placeholder="Bạn cần tìm đơn hàng gì.....?"  name="keyword" autocomplete="off" maxlength="100"></input>
        </form>
      </div>
</span>
        <div class="main">
        <table> <?php 
    }  else if ($quyentruycap==2) {
        include('topnav.php');
        $sql2 = "SELECT * FROM donhang WHERE IDUSER = " .$iduser;
        $kq2 = mysqli_query($conn, $sql2);
        ?><h1 style="text-align: center; margin: 30px;">ĐƠN HÀNG CỦA BẠN</h1> 
        <div class="main" style="margin-left: 0px;">
        <table class="table"><?php 
    }
    ?> 
        <tr>
        <th>Mã đơn hàng</th>
        <th>Tên người đặt hàng</th>
        <th>Số điện thoại</th>
        <th>Email</th>
        <th>Địa chỉ</th>
        <th>Phương thức thanh toán</th>
        <th>Tổng tiền</th>
        <th>Ngày đặt hàng</th>
        <th>Chi tiết đơn hàng</th>
        <th style="width: 185px;" colspan="3">Trạng thái đơn hàng</th>
        <th>Xóa đơn hàng</th>
        </tr>
    <?php
        while($row=mysqli_fetch_array($kq2)) {    
            $ngaydathang = $row["Ngaydathang"]; // Giá trị ngày giờ từ cột
            $date = new DateTime($ngaydathang);
            $formattedDate = $date->format("d-m-Y");
            echo '<tr>
            <td style="border-left: 1px solid gray;">'.$row["ID"].'</td>
            <td>'.$row["Ten"].'</td>
            <td>'.$row["sdt"].'</td>
            <td>'.$row["gmail"].'</td>
            <td>'.$row["diachi"].'</td>
            <td>'.$row["ptthanhtoan"].'</td>
            <td>'.number_format($row["tongtien"],0, ',', '.').'<sup>đ</sup></td>
            <td>'.$formattedDate.'</td>
            <td><a href = "chitietdonhang.php?iddh='.$row["ID"].'&quyentruycap='.$quyentruycap.'"><i class="fa fa-book" style="font-size: 20px; color:#222222"aria-hidden="true"></i></a></td>';
            if ($quyentruycap==1) {
                ?>
            <script>
            function handleClick() {
            alert("Trạng thái đã được cập nhập!.");
            }
            </script>
            <td style="width: 185px;" colspan="3">
            <form action="donhang.php?id=<?php echo $row["ID"] ?>" method="post">
            <select class="form-select half-width" name="trangthai">
            <?php 
            if ($row["Trangthai"]=="Chưa xử lý" || $row["Trangthai"]=="") {
            echo '<option value="Chưa xử lý" selected>Chưa xử lý</option>';
            echo '<option value="Đã xử lý">Đã xử lý</option>';
            echo '<option value="Đang giao hàng">Đang giao hàng</option>';
            echo '<option value="Đã hoàn thành">Đã hoàn thành</option>';
            }
            else if ($row["Trangthai"]=="Đã xử lý") {
            echo '<option value="Chưa xử lý">Chưa xử lý</option>';
            echo '<option value="Đã xử lý" selected>Đã xử lý</option>';
            echo '<option value="Đang giao hàng">Đang giao hàng</option>';
            echo '<option value="Đã hoàn thành">Đã hoàn thành</option>';
            }
            else if ($row["Trangthai"]=="Đang giao hàng") {
            echo '<option value="Chưa xử lý">Chưa xử lý</option>';
            echo '<option value="Đã xử lý">Đã xử lý</option>';
            echo '<option value="Đang giao hàng" selected>Đang giao hàng</option>';
            echo '<option value="Đã hoàn thành">Đã hoàn thành</option>';
        }
            else if ($row["Trangthai"]=="Đã hoàn thành") {
            echo '<option value="Chưa xử lý">Chưa xử lý</option>';
            echo '<option value="Đã xử lý">Đã xử lý</option>';
            echo '<option value="Đang giao hàng">Đang giao hàng</option>';
            echo '<option value="Đã hoàn thành" selected>Đã hoàn thành</option>';
            }
            ?>
            </select>
            <button type="submit" class="update" onclick="handleClick()" name="sub">Cập Nhập</button>
            </form>
            </td>
                <?php 
            }
            if ($quyentruycap==2) {
            echo '<td style="width: 185px; " colspan="3">'.$row["Trangthai"].'</td>';
            }
            echo '<td> <a href = "xoadonhang.php?id='.$row["ID"].'"><i class="fa fa-trash" style="font-size: 20px; color:#222222"aria-hidden="true"></i></a></td>';
            '</tr>';
        }
    ?>
</table>
</div>
</body>
</html>