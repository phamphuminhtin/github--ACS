<?php
    $id = $_GET['id'];
    $iddm = $_GET['iddm']; 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn= mysqli_connect("localhost", "root", "", "phoneworld");
    switch ($iddm) {
        case '1':
            $cpu = $_POST['cpu'];
            $card = $_POST['card'];
            $ram = $_POST['ram'];
            $loairam = $_POST['loairam'];
            $ocung = $_POST['ocung'];
            $kichthuocmh = $_POST['kichthuocmh'];
            $congnghemh = $_POST['congnghemh']; 
            $pin = $_POST['pin']; 
            $hedieuhanh = $_POST['hedieuhanh'];
            $dophangiai = $_POST['dophangiai'];
            $conggiaotiep = $_POST['conggiaotiep'];
            $baohanh = $_POST['baohanh'];
            $sql = "UPDATE ttchitietlaptop set CPU = '$cpu', card = '$card',  ram = '$ram', loairam = '$loairam', ocung = '$ocung', kichthuocmh = '$kichthuocmh', congnghemh = '$congnghemh', pin = '$pin', hedieuhanh = '$hedieuhanh', dophangiai = '$dophangiai', conggiaotiep = '$conggiaotiep', baohanh = '$baohanh' WHERE ID = $id ";
            break;
        
        case '2':
            $kichthuocmh = $_POST['kichthuocmh'];
            $dophangiai = $_POST['dophangiai'];
            $hedieuhanh = $_POST['hedieuhanh'];
            $congnghemh = $_POST['congnghemh'];
            $ram = $_POST['ram'];
            $rom = $_POST['rom'];
            $cameratruoc = $_POST['cameratruoc']; 
            $camerasau = $_POST['camerasau']; 
            $tinhnangmh = $_POST['tinhnangmh'];
            $sim = $_POST['sim'];
            $pin = $_POST['pin'];
            $chipset = $_POST['chipset'];
            $gpu = $_POST['gpu'];
            $baohanh = $_POST['baohanh'];
            $sql = "UPDATE ttchitietdt set Kichthuocmanhinh = '$kichthuocmh', dophangiai = '$dophangiai',  hedieuhanh = '$hedieuhanh', congnghemh = '$congnghemh', ram = '$ram', bonhotrong = '$rom', Cameratruoc = '$cameratruoc', Camerasau = '$camerasau', SIM = '$sim', tinhnangmh = '$tinhnangmh', Pin = '$pin', Chipset = '$chipset', GPU = '$gpu', baohanh = '$baohanh' WHERE ID = $id ";
            break;
                case '3':
                    $kichthuocmh = $_POST['kichthuocmh'];
                    $dophangiai = $_POST['dophangiai'];
                    $hedieuhanh = $_POST['hedieuhanh'];
                    $congnghemh = $_POST['congnghemh'];
                    $ram = $_POST['ram'];
                    $rom = $_POST['rom'];
                    $cameratruoc = $_POST['cameratruoc']; 
                    $camerasau = $_POST['camerasau']; 
                    $tinhnangmh = $_POST['tinhnangmh'];
                    $tuongthich = $_POST['tuongthich'];
                    $pin = $_POST['pin'];
                    $chipset = $_POST['chipset'];
                    $gpu = $_POST['gpu'];
                    $baohanh = $_POST['baohanh'];
                    $sql = "UPDATE ttchitietmtbang set kichthuocmh = '$kichthuocmh', dophangiai = '$dophangiai',  hedieuhanh = '$hedieuhanh', congnghemh = '$congnghemh', ram = '$ram', bonhotrong = '$rom', cameratruoc = '$cameratruoc', camerasau = '$camerasau', tuongthich = '$tuongthich', tinhnangmh = '$tinhnangmh', pin = '$pin', chipset = '$chipset', GPU = '$gpu', baohanh = '$baohanh' WHERE ID = $id ";
                    break;     
    }
    
    $conn= mysqli_connect("localhost", "root", "", "phoneworld");
    if (isset($_FILES['images'])) {
        $files = $_FILES['images'];
        $files_name = $files['name'];
        if (!empty($files_name[0])) {
            mysqli_query($conn, "DELETE FROM img_products WHERE ID_Products = $id");
            foreach ($files_name as $key => $value) {
                move_uploaded_file($files['tmp_name'][$key],'uploads/' .$value);
            }
            foreach ($files_name as $key => $value) {
                mysqli_query($conn, "INSERT INTO img_products(ID_Products, image) VALUES ($id,'$value')");
            }
        }
        }
$kq = mysqli_query($conn, $sql);
header("Location: sanpham.php");
mysqli_close($conn);
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
    <title></title>
</head>
<body>
    <?php include("menu.php") ?>
    <div class="main">
    <h2>Sửa thông tin chi tiết sản phẩm</h2>
    <?php 
      $conn3= mysqli_connect("localhost", "root", "", "phoneworld");
      switch ($iddm) {
        case '1':
            $sql3 = "SELECT * FROM ttchitietlaptop WHERE ID =" .$_GET['id'];
            break;
        
        case '2':
            $sql3 = "SELECT * FROM ttchitietdt WHERE ID =" .$_GET['id'];
            break;
        case '3':
            $sql3 = "SELECT * FROM ttchitietmtbang WHERE ID =" .$_GET['id'];
            break;
      }
      $kq3 = mysqli_query($conn3, $sql3);
      $thongtinsp = mysqli_fetch_array($kq3);
    ?>
    <form action = "" method="POST" enctype="multipart/form-data">
        <?php 
        switch ($iddm) {
            case '1':
            ?>
        CPU <br>
        <input class="form" type="text" name="cpu" value="<?php echo $thongtinsp['CPU']; ?>"><br>
        Card đồ họa <br> 
        <input class="form" type="text" name="card" value="<?php echo $thongtinsp['card']; ?>"><br>
        Dung lượng RAM<br> 
        <input class="form" type="text" name="ram" value="<?php echo $thongtinsp['ram']; ?>"><br>
        Loại RAM<br>
        <input class="form"type="text" name="loairam" value="<?php echo $thongtinsp['loairam']; ?>"><br>
        Ổ cứng<br> 
        <input class="form" type="text" name="ocung" value="<?php echo $thongtinsp['ocung']; ?>"><br>
        Kích thước màn hình<br>
        <input class="form" type="text" name="kichthuocmh" value="<?php echo $thongtinsp['kichthuocmh']; ?>"><br>
        Công nghệ màn hình<br>
        <input class="form" type="text" name="congnghemh" value="<?php echo $thongtinsp['congnghemh']; ?>"><br>
        Pin<br>
        <input class="form"type="text" name="pin" value="<?php echo $thongtinsp['pin']; ?>"><br>
        Hệ điều hành <br>
        <input class="form"type="text" name="hedieuhanh" value="<?php echo $thongtinsp['hedieuhanh']; ?>"><br>
        Độ phân giải màn hình <br>
        <input class="form" type="text" name="dophangiai" value="<?php echo $thongtinsp['dophangiai']; ?>"><br>
        Cổng giao tiếp<br>
        <input class="form" type="text" name="conggiaotiep" value="<?php echo $thongtinsp['conggiaotiep']; ?>"><br>
        Bảo hành<br>
        <input class="form" type="text" name="baohanh" value="<?php echo $thongtinsp['baohanh']; ?>"><br><br>
        <br>
            <?php 
            break;
            
            case '2':
                ?>
        Kích thước màn hình <br>
        <input class="form" type="text" name="kichthuocmh" value="<?php echo $thongtinsp['Kichthuocmanhinh']; ?>"><br>
        Công nghệ màn hình <br> 
        <input class="form" type="text" name="congnghemh" value="<?php echo $thongtinsp['congnghemh']; ?>"><br>
        Camera sau<br> 
        <input class="form" type="text" name="camerasau" value="<?php echo $thongtinsp['Camerasau']; ?>"><br>
        Camera trước<br>
        <input class="form"type="text" name="cameratruoc" value="<?php echo $thongtinsp['Cameratruoc']; ?>"><br>
        Chipset<br> 
        <input class="form" type="text" name="chipset" value="<?php echo $thongtinsp['Chipset']; ?>"><br>
        Dung lượng RAM<br>
        <input class="form" type="text" name="ram" value="<?php echo $thongtinsp['ram']; ?>"><br>
        Bộ nhớ trong<br>
        <input class="form" type="text" name="rom" value="<?php echo $thongtinsp['bonhotrong']; ?>" ><br>
        Pin<br>
        <input class="form"type="text" name="pin" value="<?php echo $thongtinsp['Pin']; ?>"><br>
        Thẻ SIM<br>
        <input class="form" type="text" name="sim" value="<?php echo $thongtinsp['SIM']; ?>"><br>
        Hệ điều hành <br>
        <input class="form"type="text" name="hedieuhanh" value="<?php echo $thongtinsp['hedieuhanh']; ?>"><br>
        Độ phân giải màn hình <br>
        <input class="form" type="text" name="dophangiai" value="<?php echo $thongtinsp['dophangiai']; ?>"><br>
        Tính năng màn hình<br>
        <input class="form" type="text" name="tinhnangmh" value="<?php echo $thongtinsp['tinhnangmh']; ?>"><br>
        GPU<br>
        <input class="form" type="text" name="gpu" value="<?php echo $thongtinsp['GPU']; ?>"><br>
        Bảo hành<br>
        <input class="form" type="text" name="baohanh" value="<?php echo $thongtinsp['baohanh']; ?>"><br><br>
        <br>
                    <?php 
            break;
            case '3':
                ?>
        Kích thước màn hình <br>
        <input class="form" type="text" name="kichthuocmh" value="<?php echo $thongtinsp['Kichthuocmanhinh']; ?>"><br>
        Công nghệ màn hình <br> 
        <input class="form" type="text" name="congnghemh" value="<?php echo $thongtinsp['congnghemh']; ?>"><br>
        Camera sau<br> 
        <input class="form" type="text" name="camerasau" value="<?php echo $thongtinsp['Camerasau']; ?>"><br>
        Camera trước<br>
        <input class="form"type="text" name="cameratruoc" value="<?php echo $thongtinsp['Cameratruoc']; ?>"><br>
        Chipset<br> 
        <input class="form" type="text" name="chipset" value="<?php echo $thongtinsp['Chipset']; ?>"><br>
        Dung lượng RAM<br>
        <input class="form" type="text" name="ram" value="<?php echo $thongtinsp['ram']; ?>"><br>
        Bộ nhớ trong<br>
        <input class="form" type="text" name="rom" value="<?php echo $thongtinsp['bonhotrong']; ?>" ><br>
        Pin<br>
        <input class="form"type="text" name="pin" value="<?php echo $thongtinsp['Pin']; ?>"><br>
        Hệ điều hành <br>
        <input class="form"type="text" name="hedieuhanh" value="<?php echo $thongtinsp['hedieuhanh']; ?>"><br>
        Độ phân giải màn hình <br>
        <input class="form" type="text" name="dophangiai" value="<?php echo $thongtinsp['dophangiai']; ?>"><br>
        Tính năng màn hình<br>
        <input class="form" type="text" name="tinhnangmh" value="<?php echo $thongtinsp['tinhnangmh']; ?>"><br>
        Tương thích<br>
        <input class="form" type="text" name="tuongthich" value="<?php echo $thongtinsp['tuongthich']; ?>"><br>
        GPU<br>
        <input class="form" type="text" name="gpu" value="<?php echo $thongtinsp['GPU']; ?>"><br>
        Bảo hành<br>
        <input class="form" type="text" name="baohanh" value="<?php echo $thongtinsp['baohanh']; ?>"><br><br>
        <br>
                    <?php 
            break;
        }
        ?>
        Ảnh mô tả <br>
        <input type="file" name="images[]" multiple = "multiple" style="cursor: pointer;"><br>
        <div class="container-fluid">
        <div class="row">
            <?php 
        $id = $_GET['id'];
        $conn= mysqli_connect("localhost", "root", "", "phoneworld");
        $img_pro = mysqli_query($conn, "SELECT * FROM img_products WHERE ID_Products = $id");
        while($anhmota = mysqli_fetch_array($img_pro)) { 
            echo "<div class='col-md-2' style='margin: 15px;'><img src='uploads/".$anhmota['image']."' width='150'>" . "</div>";
       } ?>
    </div>
</div>
        <br><input type="submit" value="Sửa" name="submit" class="submit">
    </form>
    </div>
</body>
</html>
