<?php

$key_username = 'admin';
$key_password = 'password';

if (isset($_POST["dangnhap"])) {
    $tendangnhap = $_POST['username'];
    $matkhau = $_POST['password'];

    $error = [];

    if (empty($tendangnhap)) {
        $error['user_error_emp'] = "Tên đăng nhập không được để trống";
    }

    if (empty($matkhau)) {
        $error['pass_error_emp'] = "Mật khẩu không được để trống";
    }

    if (isset($_COOKIE[$key_username])) {
        if (
            $tendangnhap != $_COOKIE[$key_username]
            || $matkhau != $_COOKIE[$key_password]
        ) {
            $error['sai_user'] = "Tên đăng nhập hoặc mật khẩu không đúng!";
        }
    }


    if (!$error) {
        setcookie($key_username, $tendangnhap, time() + 60 * 60 * 2);

        setcookie($key_password, $matkhau, time() + 60 * 60 * 2);

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

    <h1>Đăng nhập</h1>

    <?php
    if (isset($error['sai_user'])) {
        echo "<h2>" . $error['sai_user'] . "</h2>";
        echo "<br>";
    }
    ?>

    <form method="post">
        Tên đăng nhập:
        <input type="text" name="username"
            value="<?php if (isset($_COOKIE[$key_username]))
                echo $_COOKIE[$key_username]; ?>">

        <?php if (isset($error['user_error_emp']))
            echo $error['user_error_emp']; ?>

        <br>
        Mật khẩu:
        <input type="text" name="password"
            value="<?php if (isset($_COOKIE[$key_password]))
                echo $_COOKIE[$key_password]; ?>">

        <?php if (isset($error['pass_error_emp']))
            echo $error['pass_error_emp']; ?>
        <br>
        <input type="submit" name="dangnhap" value="Đăng nhập">

    </form>

</body>

</html>