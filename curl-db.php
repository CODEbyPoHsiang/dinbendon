<?php

$dbhost = 'localhost';
$dbuser = 'root';
$dbpasswd = '';
$dbname = 'db';
$dsn = "mysql:host=".$dbhost.";dbname=".$dbname;

try
{
    $conn = new PDO($dsn,$dbuser,$dbpasswd);
    $conn->exec("SET CHARACTER SET utf8");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "連接資料庫成功"."<br>";
}
catch(PDOException $e)
{
    echo "資料庫連接失敗: ".$e->getMessage();
}
?>
