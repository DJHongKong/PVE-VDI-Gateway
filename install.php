<?php
header('content-type:text/html;charset=utf-8');
unlink('admin/user.db');
unlink('temp/spice.vv');
class MyDB extends SQLite3
{
   function __construct()
   {
      $this->open('admin/user.db');
   }
}
$db = new MyDB();
if(!$db){
   echo $db->lastErrorMsg();
} else {
   echo "Opened database successfully\n";
}

$sql =<<<EOF
   CREATE TABLE user
   (ID INTEGER PRIMARY KEY AUTOINCREMENT,
   USERNAME TEXT NOT NULL,
   PASSWORD TEXT NOT NULL,
   VMID INT NOT NULL,
   NODE TEXT NOT NULL);
EOF;

$ret = $db->exec($sql);
if(!$ret){
   echo $db->lastErrorMsg();
} else {
   echo "Table created successfully\n";
}
$db->close();
$vvflie = fopen("temp/spice.vv", "w");
fclose($vvflie);
copy("install.php","install.php.bak");
unlink('install.php');
echo "<script type='text/javascript'>alert('初始化成功');
location.href='admin/admin.html';
</script>";
?>