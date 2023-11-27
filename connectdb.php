<?php

    $server = 'localhost';
    $db_username = 'root';
    $db_password = '';
    $db_database = 'lab6';

    $connection = mysqli_connect($server, $db_username, $db_password, $db_database);

    $TABLE_NAME = 'sanpham';

    $TABLE_NAME_LOAI = 'loaisanpham';

    if (mysqli_connect_errno()) {
        echo '<p>Loi ket noi db!</p>';
    } else {
        echo '<p>Ket noi db thanh cong!</p>';
    }

    function debug_to_console($data)
    {
        $output = $data;
        if (is_array($output))
            $output = implode(',', $output);

        echo "<script>console.log('Debug Objects: " . (string)$output . "' );</script>";
    }
?>