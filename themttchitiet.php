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
            $sql = "INSERT INTO ttchitietlaptop (ID, CPU, card, ram, loairam, ocung, kichthuocmh, congnghemh, pin, hedieuhanh, dophangiai, conggiaotiep, baohanh) VALUES ($id,'$cpu','$card','$ram','$loairam', '$ocung', '$kichthuocmh', '$congnghemh', '$pin', '$hedieuhanh', '$dophangiai', '$conggiaotiep', '$baohanh')";
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
            $sql = "INSERT INTO ttchitietdt (ID, Kichthuocmanhinh, dophangiai, hedieuhanh, congnghemh, ram, bonhotrong, Cameratruoc, Camerasau, SIM, tinhnangmh, Pin, Chipset, GPU, baohanh) VALUES ($id,'$kichthuocmh','$dophangiai','$hedieuhanh', '$congnghemh' ,'$ram', '$rom', '$cameratruoc', '$camerasau', '$sim', '$tinhnangmh', '$pin', '$chipset', '$gpu', '$baohanh')";
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
                    $sql = "INSERT INTO ttchitietmtbang (ID, kichthuocmh, dophangiai, hedieuhanh, congnghemh, ram, bonhotrong, cameratruoc, camerasau, tuongthich, tinhnangmh, pin, chipset, GPU, baohanh) VALUES ($id,'$kichthuocmh','$dophangiai','$hedieuhanh', '$congnghemh' ,'$ram', '$rom', '$cameratruoc', '$camerasau', '$tuongthich', '$tinhnangmh', '$pin', '$chipset', '$gpu', '$baohanh')";
                        break;     
    }
    
    $kq = mysqli_query($conn, $sql);
    if (isset($_FILES['images'])) {
        $files = $_FILES['images'];
        $files_name = $files['name'];
        foreach ($files_name as $key => $value) {
            move_uploaded_file($files['tmp_name'][$key],'uploads/' .$value);
        }
        }
foreach ($files_name as $key => $value) {
    mysqli_query($conn, "INSERT INTO img_products(ID_Products, image) VALUES ($id,'$value')" );
}
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
    <title></title>
</head>
<body>
    <?php include("menu.php") ?>
    <div class="main">
    <h2>Thêm thông tin sản phẩm</h2>
    <form action = "" method="POST" enctype="multipart/form-data">
        Ảnh mô tả <br>
        <input class="form" type="file" name="images[]" multiple = "multiple"><br>
        <?php 
        switch ($iddm) {
            case '1':
            ?>
        CPU <br>
        <input class="form" type="text" name="cpu"><br>
        Card đồ họa <br> 
        <input class="form" type="text" name="card"><br>
        Dung lượng RAM<br> 
        <input class="form" type="text" name="ram"><br>
        Loại RAM<br>
        <input class="form"type="text" name="loairam"><br>
        Ổ cứng<br> 
        <input class="form" type="text" name="ocung"><br>
        Kích thước màn hình<br>
        <input class="form" type="text" name="kichthuocmh"><br>
        Công nghệ màn hình<br>
        <input class="form" type="text" name="congnghemh"><br>
        Pin<br>
        <input class="form"type="text" name="pin"><br>
        Hệ điều hành <br>
        <input class="form"type="text" name="hedieuhanh"><br>
        Độ phân giải màn hình <br>
        <input class="form" type="text" name="dophangiai"><br>
        Cổng giao tiếp<br>
        <input class="form" type="text" name="conggiaotiep"><br>
        Bảo hành<br>
        <input class="form" type="text" name="baohanh"><br><br>
        <br>
            <?php 
            break;
            
            case '2':
                ?>
        Kích thước màn hình <br>
        <input class="form" type="text" name="kichthuocmh"><br>
        Công nghệ màn hình <br> 
        <input class="form" type="text" name="congnghemh"><br>
        Camera sau<br> 
        <input class="form" type="text" name="camerasau"><br>
        Camera trước<br>
        <input class="form"type="text" name="cameratruoc"><br>
        Chipset<br> 
        <input class="form" type="text" name="chipset"><br>
        Dung lượng RAM<br>
        <input class="form" type="text" name="ram"><br>
        Bộ nhớ trong<br>
        <input class="form" type="text" name="rom"><br>
        Pin<br>
        <input class="form"type="text" name="pin"><br>
        Thẻ SIM<br>
        <input class="form" type="text" name="sim"><br>
        Hệ điều hành <br>
        <input class="form"type="text" name="hedieuhanh"><br>
        Độ phân giải màn hình <br>
        <input class="form" type="text" name="dophangiai"><br>
        Tính năng màn hình<br>
        <input class="form" type="text" name="tinhnangmh"><br>
        GPU<br>
        <input class="form" type="text" name="gpu"><br>
        Bảo hành<br>
        <input class="form" type="text" name="baohanh"><br><br>
        <br>
                    <?php 
            break;
            case '3':
                ?>
        Kích thước màn hình <br>
        <input class="form" type="text" name="kichthuocmh"><br>
        Công nghệ màn hình <br> 
        <input class="form" type="text" name="congnghemh"><br>
        Camera sau<br> 
        <input class="form" type="text" name="camerasau"><br>
        Camera trước<br>
        <input class="form"type="text" name="cameratruoc"><br>
        Chipset<br> 
        <input class="form" type="text" name="chipset"><br>
        Dung lượng RAM<br>
        <input class="form" type="text" name="ram"><br>
        Bộ nhớ trong<br>
        <input class="form" type="text" name="rom"><br>
        Pin<br>
        <input class="form"type="text" name="pin"><br>
        Hệ điều hành <br>
        <input class="form"type="text" name="hedieuhanh"><br>
        Độ phân giải màn hình <br>
        <input class="form" type="text" name="dophangiai"><br>
        Tính năng màn hình<br>
        <input class="form" type="text" name="tinhnangmh"><br>
        Tương thích<br>
        <input class="form" type="text" name="tuongthich"><br>
        GPU<br>
        <input class="form" type="text" name="gpu"><br>
        Bảo hành<br>
        <input class="form" type="text" name="baohanh"><br><br>
        <br>
                    <?php 
            break;
        }
        ?>
        <input type="submit" value="Thêm" name="submit" class="submit">
    </form>
    </div>
</body>
</html>
