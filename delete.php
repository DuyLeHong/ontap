<?php 
    include ("connectdb.php");

    $id = $_GET['id'];

    $sql = "DELETE FROM ".$TABLE_NAME." WHERE id = '$id'";

    $connection->execute_query($sql);

    header("location:index.php");

?>