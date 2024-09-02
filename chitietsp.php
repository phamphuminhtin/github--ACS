<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="reponsive.css">
    <title>Document</title>
    <style>
</style>
<?php 
$id = $_GET['id'];
$iddm = $_GET['iddm'];
$conn= mysqli_connect("localhost", "root", "", "phoneworld");
$sql = "SELECT * FROM sanpham WHERE ID =" .$id;
$kq = mysqli_query($conn, $sql);
switch ($iddm) {
  case '1':
  $sql1 = "SELECT * FROM ttchitietlaptop WHERE ID =" .$id;
  break;  
  case '2':
  $sql1 = "SELECT * FROM ttchitietdt WHERE ID =" .$id;
  break;
  case '3':
  $sql1 = "SELECT * FROM ttchitietmtbang WHERE ID =" .$id;
  break;
}
$kq1 = mysqli_query($conn, $sql1);
$thongtinsp = mysqli_fetch_array($kq);
$thongtinchitiet = mysqli_fetch_array($kq1);
$img_pro = mysqli_query($conn, "SELECT * FROM img_products WHERE ID_Products = $id");
$sql2 = "SELECT * FROM blsanpham WHERE id_sp =" .$id;
$kq2 = mysqli_query($conn, $sql2);
?>
</head>
<body style="background-color: #efefef;"> 
     <div class="mainig">
     <div>
    <h1 class="product-name"><?php echo $thongtinsp['Tensp'];?>
    <a href="Trangchu.php" style="float: right;"><i class="fa fa-reply-all" style="font-size: 35px; color:#222222; margin: 15px;" aria-hidden="true"></i></a></h1>
    <hr width="100%" size="2px" color="lightgray"/>
     </div>
     <div class="container0">
    <div class="image" id="myimg">
    <img src="uploads/<?php echo $thongtinsp['Anhsp']; ?>" class="img-feature">
      <div class="control prev"><i class="fa fa-chevron-left" aria-hidden="true"></i></div>
      <div class="control next"><i class="fa fa-chevron-right" aria-hidden="true"></i></div>
      </div>
    <div class="list-image">
                <div><img src="uploads/<?php echo $thongtinsp['Anhsp']; ?>"></div>
                  <?php
                  while($anhmota = mysqli_fetch_array($img_pro)) { 
                   echo "<div><img src='uploads/".$anhmota['image']."' width='150'>" . "</div>";
              } ?> 
            </div>
    </div>     
    <div class="price">
      <span class="price0" id="price0"><?php echo number_format($thongtinsp['Giasp'],0, ',', '.') ; ?><sup>đ</sup></span>
      <span class="price1" id="price1"><?php echo number_format($thongtinsp['Giagocsp'],0, ',', '.'); ?><sup>đ</sup></span>
      </div> 
    <div class="container1">  
    <div class="content"> 
        <table>
        <tr style="position: sticky;">
        <th colspan="2" class="thead">Thông số kỹ thuật</th>
        </tr>
        <?php 
        switch ($iddm ) {
          case '1':
          ?>
            <tbody>
            <tr>
            <td>CPU</td>
            <td id="td1"><?php echo $thongtinchitiet['CPU']; ?></td>
            </tr>
            <tr>
            <td>Loại card đồ họa</td>
            <td id="td2"><?php echo $thongtinchitiet['card']; ?></td>
            </tr>
            <tr>
            <td>Dung lượng RAM</td>
            <td id="td3"><?php echo $thongtinchitiet['ram']; ?></td>
            </tr>
            <tr>
            <td>Loại RAM</td>
            <td id="td4"><?php echo $thongtinchitiet['loairam']; ?></td>
            </tr>    
            <tr>
            <td>Ổ cứng</td>
            <td id="td5"><?php echo $thongtinchitiet['ocung']; ?></td>
            </tr>
            <tr>
            <td>Kích thước màn hình</td>
            <td id="td6"><?php echo $thongtinchitiet['kichthuocmh']; ?></td>
            </tr>   
            <tr>
            <td>Công nghệ màn hình</td>
            <td id="td7"><?php echo $thongtinchitiet['congnghemh']; ?></td>
            </tr>      
            <tr>
            <td>Pin</td>
            <td id="td8"><?php echo $thongtinchitiet['pin']; ?></td>
            </tr>  
            <tr>
            <td>Hệ điều hành</td>
            <td id="td9"><?php echo $thongtinchitiet['hedieuhanh']; ?></td>
            </tr>
            <tr>
            <td>Độ phân giải màn hình</td>
            <td id="td10"><?php echo $thongtinchitiet['dophangiai']; ?></td>
            </tr>       
            <tr>
            <td>Cổng giao tiếp</td>
            <td id="td11"><?php echo $thongtinchitiet['conggiaotiep']; ?></td>
            </tr>
            <tr>
            <tr>
            <td>Bảo hành</td>
            <td id="td12"><?php echo $thongtinchitiet['baohanh']; ?></td>
            </tr>              
            </tbody>
          <?php 
            break;
          
          case '2':
           ?> 
               <tbody>
            <tr>
            <td>Kích thước màn hình</td>
            <td id="td1"><?php echo $thongtinchitiet['Kichthuocmanhinh']; ?></td>
            </tr>
            <tr>
            <td>Công nghệ màn hình</td>
            <td id="td2"><?php echo $thongtinchitiet['congnghemh']; ?></td>
            </tr>
            <tr>
            <td>Camera sau</td>
            <td id="td3"><?php echo $thongtinchitiet['Camerasau']; ?></td>
            </tr>
            <tr>
            <td>Camera trước</td>
            <td id="td4"><?php echo $thongtinchitiet['Cameratruoc']; ?></td>
            </tr>    
            <tr>
            <td>Chipset</td>
            <td id="td5"><?php echo $thongtinchitiet['Chipset']; ?></td>
            </tr>
            <tr>
            <td>Dung lượng RAM</td>
            <td id="td6"><?php echo $thongtinchitiet['ram']; ?></td>
            </tr>   
            <tr>
            <td>Bộ nhớ trong</td>
            <td id="td7"><?php echo $thongtinchitiet['bonhotrong']; ?></td>
            </tr>      
            <tr>
            <td>Pin</td>
            <td id="td8"><?php echo $thongtinchitiet['Pin']; ?></td>
            </tr>  
            <tr>
            <td>Thẻ SIM</td>
            <td id="td9"><?php echo $thongtinchitiet['SIM']; ?></td>
            </tr>
            <tr>
            <td>Hệ điều hành</td>
            <td id="td10"><?php echo $thongtinchitiet['hedieuhanh']; ?></td>
            </tr>       
            <tr>
            <td>Độ phân giải màn hình</td>
            <td id="td11"><?php echo $thongtinchitiet['dophangiai']; ?></td>
            </tr>
            <tr>
            <td>Tính năng màn hình</td>
            <td id="td12"><?php echo $thongtinchitiet['tinhnangmh']; ?></td>
            </tr>       
            <tr>
            <td>GPU</td>
            <td id="td13"><?php echo $thongtinchitiet['GPU']; ?></td>
            </tr>
            <tr>
            <tr>
            <td>Bảo hành</td>
            <td id="td14"><?php echo $thongtinchitiet['baohanh']; ?></td>
            </tr>              
            </tbody>
           <?php 
            break;
            case '3':
              ?> 
                  <tbody>
               <tr>
               <td>Kích thước màn hình</td>
               <td id="td1"><?php echo $thongtinchitiet['kichthuocmh']; ?></td>
               </tr>
               <tr>
               <td>Công nghệ màn hình</td>
               <td id="td2"><?php echo $thongtinchitiet['congnghemh']; ?></td>
               </tr>
               <tr>
               <td>Camera sau</td>
               <td id="td3"><?php echo $thongtinchitiet['camerasau']; ?></td>
               </tr>
               <tr>
               <td>Camera trước</td>
               <td id="td4"><?php echo $thongtinchitiet['cameratruoc']; ?></td>
               </tr>    
               <tr>
               <td>Chipset</td>
               <td id="td5"><?php echo $thongtinchitiet['chipset']; ?></td>
               </tr>
               <tr>
               <td>Dung lượng RAM</td>
               <td id="td6"><?php echo $thongtinchitiet['ram']; ?></td>
               </tr>   
               <tr>
               <td>Bộ nhớ trong</td>
               <td id="td7"><?php echo $thongtinchitiet['bonhotrong']; ?></td>
               </tr>      
               <tr>
               <td>Pin</td>
               <td id="td8"><?php echo $thongtinchitiet['pin']; ?></td>
               </tr>  
               <tr>
               <td>Hệ điều hành</td>
               <td id="td9"><?php echo $thongtinchitiet['hedieuhanh']; ?></td>
               </tr>       
               <tr>
               <td>Độ phân giải màn hình</td>
               <td id="td10"><?php echo $thongtinchitiet['dophangiai']; ?></td>
               </tr>
               <tr>
               <td>Tính năng màn hình</td>
               <td id="td11"><?php echo $thongtinchitiet['tinhnangmh']; ?></td>
               </tr>
               <tr>
               <td>Tương thích</td>
               <td id="td12"><?php echo $thongtinchitiet['tuongthich']; ?></td>
               </tr>       
               <tr>
               <td>GPU</td>
               <td id="td13"><?php echo $thongtinchitiet['GPU']; ?></td>
               </tr>
               <tr>
               <tr>
               <td>Bảo hành</td>
               <td id="td14"><?php echo $thongtinchitiet['baohanh']; ?></td>
               </tr>              
               </tbody>
            <?php 
        } 
        ?>
          
            </table>
        </div> 
        <?php if($thongtinsp['SoLuong']>0) {?>
        <form action="cart.php" method="post">
          <?php 
             echo '  <input type="hidden" name="tensp" value="'.$thongtinsp["Tensp"].'">';
             echo '  <input type="hidden" name="idsp" value="'.$thongtinsp["ID"].'">';
             echo '  <input type="hidden" name="gia" value="'.$thongtinsp["Giasp"].'">';
             echo '  <input type="hidden" name="hinh" value="'.$thongtinsp["Anhsp"].'">';
             echo '  <input type="hidden" name="slkho" value="'.$thongtinsp["SoLuong"].'">';
          ?>
        
        <button class="addcart1">
        <h2 style="color: white; margin: 0;">Thêm vào giỏ hàng &nbsp;<i class="fa fa-shopping-cart" aria-hidden="true"></i></h2>
        </button> 
        </form>
        <?php } else {  ?>
        <button class="addcart1">
        <h2 style="color: white; margin: 0;">Sản phẩm hiện đã hết hàng</h2>
        </button>
        <?php } ?>
        <div class="comment-container">
        <h1>Bình luận sản phẩm</h1>
          <?php  if (isset($_SESSION['User'])) { ?>
          <form class="form-inline" action="thembl.php" method="POST">
          <input type="hidden" name="id" value="<?php echo $id; ?>" >
          <input type="hidden" name="iddm" value="<?php echo $iddm; ?>" >
          <div class="form-group mb-2">
          <div class="mb-7">
          <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" cols="90" name="noidungbl"></textarea>
          <button class="send" type="submit" name="send" id="sendButton">
  <i class="fa fa-paper-plane" aria-hidden="true"></i>&nbsp;&nbsp;Gửi
</button>

<script>
  var sendButton = document.getElementById("sendButton");
  sendButton.addEventListener("click", checkTextArea);

  function checkTextArea() {
    var textareaValue = document.getElementById("exampleFormControlTextarea1").value;
    if (textareaValue.trim().length === 0) {
      alert("Vui lòng nhập bình luận.");
    }
  }
</script>
          </div>
          </form>
          <?php } else { ?>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" cols="90" name="noidungbl"></textarea>
          <button type="submit" class="send" type="submit" name="send"  onclick="document.getElementById('id01').style.display='block'"><i class="fa fa-paper-plane" aria-hidden="true"></i>&nbsp;&nbsp;Gửi</button>
          <div id="id01" class="modal">
  <div class="modal-content1">
    <div class="containermodalconment">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      <h2>Bạn chưa đăng nhập</h2>
      <p>Hãy đăng nhập để có thể xem và đọc bình luận</p>
      <hr>
      <div class="clearfix">
      <a href="dangky.php"><button class="cancelbtn">Đăng ký</button></a>
      <a href="dangnhap.php"><button class="signupbtn">Đăng nhập</button></a>
      </div>
    </div>
  </div>
</div>
          <?php } ?>
          <div class="list-comment">
          <hr>
          <?php
$rows = array(); // Mảng để lưu các hàng
$colors = array(); // Mảng kết hợp để lưu màu của mỗi người
// Truy vấn từ CSDL và lưu các hàng vào mảng $rows
while ($row = mysqli_fetch_array($kq2)) {
    $rows[] = $row;
    $ten = $row["ten"];
    if (!isset($colors[$ten])) {
        // Nếu chưa có màu được gán cho người này, tạo một màu ngẫu nhiên mới
        $randomColor = sprintf(
            'rgb(%d, %d, %d)',
            rand(0, 255),
            rand(0, 255),
            rand(0, 255)
        );
        $colors[$ten] = $randomColor;
    }
}
// Đảo ngược thứ tự các hàng trong mảng
$rows = array_reverse($rows);
// Hiển thị các hàng theo thứ tự từ cuối đến đầu
foreach ($rows as $row) {
    $ten = $row["ten"];
    $chuCaiDau = mb_substr($ten, 0, 1, "UTF-8");
    $ngayGio = $row["ngay_gio"]; // Giá trị ngày giờ từ cột
    $date = new DateTime($ngayGio);
    $formattedDate = $date->format("d-m-Y");
    $randomColor = $colors[$ten];

    echo '<div class="item-comment">';
    echo '<div class="item-comment-box">';
    echo '<div class="box-cmt-info">';
    echo '<div class="box-info">';
    echo '<div class="box-info-avatar">';
    echo '<span style="background-color: '.$randomColor.';">'.$chuCaiDau.'</span>';
    echo '</div>';
    echo '<p class="box-info__name">'.$row["ten"].'</p>';
    echo '</div>';
    echo '<div class="box-time-cmt">'.$formattedDate.'</div>';
    echo '</div>';
    echo '<div class="box-cmt-question">';
    echo '<div class="content-cmt">';
    echo '<p>'.$row["noidungbl"].'</p>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}
?>
          </div>
          </div>
</body>
<script src="js.js"></script>
</html>