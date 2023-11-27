<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        table,
        th,
        td {
            border: 1px solid black;
        }
    </style>
</head>

<body>
    <?php
    include("connectdb.php");
    include("model/sanpham.php");

    ?>
    <h1>Danh sach san pham</h1>

    <?php
    // Thực hiện truy vấn SELECT
    $sql = "SELECT * FROM ".$TABLE_NAME;
    $result = $connection->query($sql);
    //var_dump($result);
    
    $arraySanphams = array();

    while ($row = $result->fetch_assoc()) {
        $sanpham = new SanPham($row["id"], $row["name"], $row["loaisp"], $row["imgUrl"], $row["price"]);
        array_push($arraySanphams, $sanpham);

        debug_to_console($sanpham);
    }

    // Đóng kết nối
    //$conn->close();
    
    ?>

    <table>
        <tr>
            <th>id</th>
            <th>Tên sản phẩm</th>
            <th>Loại SP</th>
            <th>Ảnh SP</th>
            <th>Giá</th>
            <th>Hành động</th>
        </tr>

        <?php foreach ($arraySanphams as $sp) {?>
        <tr>
            <td><?php echo $sp->id?></td>
            <td><?php echo $sp->name?></td>
            <td><?php echo $sp->loaisp?></td>
            <td><img src="<?php echo $sp->imgUrl?>" alt="" width='200'></td> 
            <td><?php echo $sp->price?></td> 

            <td>
                <a href="edit.php?id=<?php echo $value['id']; ?>">Sửa</a>
                <a href="javascript:confirmDelete('delete.php?id=<?php echo $sp->id;?>')">Xóa</a>
            </td>
        </tr>    
        <?php } ?>

    </table>

    <script>
    function confirmDelete(delUrl) {
        if (confirm("Bạn có muốn xóa không ? ")) {
            document.location = delUrl;
        }
    }
</script>

    

</body>

</html>