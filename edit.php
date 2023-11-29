<?php
include "connectdb.php";
include "model/sanpham.php";

$sql = "SELECT * FROM " . $TABLE_NAME_LOAI;
$resultLoai = array();

$res = $connection->query($sql);

while ($row2 = $res->fetch_assoc()) {
    array_push($resultLoai, $row2);
}

$idSp = $_GET['id'];

$sqlGetSP = 'Select * from '. $TABLE_NAME .' Where id ='. $idSp;

$sanphamCu = $connection->query($sqlGetSP)->fetch_assoc();

// $sanphamCu = new SanPham($row2['id'], $row2['name'], $row2['loaisp'], $row2['imgUrl'], $row2['price']);


//var_dump($sanphamCu);

//var_dump($resultLoai);

// foreach ($resultLoai as $key => $value) {
//     var_dump($value);
// }


$error = [];
if (isset($_POST['sua'])) {
    $name = $_POST['name'];
    $loai_sp_id = $_POST['loai_sanpham_id'];
    $price = $_POST['price'];
    // validate 1 điểm
    if (empty($name)) { // email trống
        $error['ten_emp'] = "Bạn không được để trống tên";
    }
    if (empty($price)) {
        $error['gia_emp'] = "Bạn không được để trống giá";
    }
    if ($price < 0) {
        $error['gia_am'] = "Giá không được phép nhỏ hơn 0 ";
    }

    $name_img = '';
    //xử lý thêm ảnh
    if (isset($_FILES['image'])) {
        //thư mục sẽ lưu ảnh
        $target_dir = "img/";
        // lấy tên của hình ảnh
        $name_img = $_FILES["image"]["name"];
        // tạo ra 1 biến ghép đường dẫn của thư mục với tên hình ảnh
        $target_file = $target_dir . $name_img;
        //di chuyển hình ảnh vào thư mục
        move_uploaded_file($_FILES["image"]['tmp_name'], $target_file);
    }
    //nếu như không có lỗi gì thì sẽ thêm vào db
    if (!$error) {

        if ($name_img == '') {
            $name_img = $sanphamCu['imgUrl'];
        }

        $sql = "UPDATE " . $TABLE_NAME . " SET name='".$name. "', price='".$price. "', loaisp='".$loai_sp_id."', imgUrl='".$name_img."' WHERE id = ".$idSp;

        $connection->execute_query($sql);
        echo "Sửa sản phẩm thành công!";

        header('Location: index.php');
    }


}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="POST" enctype="multipart/form-data">
        Tên <input type="text" name="name" 
        value="<?php echo $sanphamCu['name'];?>" /></br>
        
        Giá <input type="text" name="price" 
        value="<?php echo $sanphamCu['price']; ?>"/>
        <?php echo isset($error['gia_emp']) ? $error['gia_emp'] : "" ?>
        <?php echo isset($error['gia_am']) ? $error['gia_am'] : "" ?>
        
        <br>
        Hình ảnh
        <input type="file" name="image" 
        value=<?php echo $sanphamCu['imgUrl']?>></br>
        Loại sản phẩm
        <select name="loai_sanpham_id"
                >
            <?php foreach ($resultLoai as $loaisp) { 
                    $sl = '';
                    if ($loaisp['id'] == $sanphamCu['loaisp'])    {
                        $sl = "selected"; 
                        // debug_to_console($sl.$loaisp['ten']);
                    }
                ?>

                <option value="<?php echo $loaisp["id"];?>" <?php echo $sl;?>>
                    <?php echo $loaisp["ten"]; ?>
                </option>
            <?php } ?>
        </select>
        <input type="submit" name="sua" value="Sửa">

    </form>
</body>

</html>