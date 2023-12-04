<?php
include "connectdb.php";
$sql = "SELECT * FROM " . $TABLE_NAME_LOAI;
$resultLoai = array();

$res = $connection->query($sql);

while ($row2 = $res->fetch_assoc()) {
    array_push($resultLoai, $row2);
}

//var_dump($resultLoai);

// foreach ($resultLoai as $key => $value) {
//     var_dump($value);
// }


$error = [];
if (isset($_POST['them'])) {
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

        $sql = "INSERT INTO " . $TABLE_NAME . " VALUES (null,'$name','$loai_sp_id','$name_img','$price')";

        $connection->execute_query($sql);
        echo "Thêm sản phẩm thành công";

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
        Tên <input type="text" name="name" />
        <?php echo isset($error['ten_emp']) ? $error['ten_emp'] : "" ?>
        </br>

        Giá <input type="text" name="price" />
        <?php echo isset($error['gia_emp']) ? $error['gia_emp'] : "" ?>
        <?php echo isset($error['gia_am']) ? $error['gia_am'] : "" ?>
        </br>
        Hình ảnh
        <input type="file" name="image"></br>
        Loại sản phẩm
        <select name="loai_sanpham_id">
            <?php foreach ($resultLoai as $loaisp) { ?>
                <option value="<?php echo $loaisp["id"]; ?>">
                    <?php echo $loaisp["ten"]; ?>
                </option>
            <?php } ?>
        </select>
        <input type="submit" name="them" value="Thêm">

    </form>
</body>

</html>