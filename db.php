<?php
//將爬出的資料寫入資料庫
//PDO 寫法
$dbhost = 'localhost';
$dbuser = 'root';
$dbpasswd = '';
$dbname = 'db';
$dsn = "mysql:host=".$dbhost.";dbname=".$dbname;

try
{
    $conn = new PDO($dsn,$dbuser,$dbpasswd);
    $conn->exec("SET CHARACTER SET utf8");
    $conn->query("TRUNCATE TABLE stores");//清空資料表
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "連接資料庫成功"."<br>";
}
catch(PDOException $e)
{
    echo "資料庫連接失敗: ".$e->getMessage();
}


$a= $match[0];//若直接讀取($store)變數值只會寫入最後一筆資料，需要用for迴圈跑
for ($i=0;$i<count($a);$i++)
{
 $sqldata[] = "('".strip_tags($a[$i])."')";
}

try
{
  $sql  = "INSERT INTO `stores` (`name`) VALUES(".implode ('),(', $sqldata).")";
  $conn->query($sql);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "資料已成功寫入資料庫"."<br>";
  echo "<br>".'資料寫入時間:'.date("Y-m-d H:i:s",(time()+8*3600))."<br>";
}
catch(PDOException $e)
{
echo "資料寫入資料庫失敗: ".$e->getMessage();
}
$conn = NULL;

?>
