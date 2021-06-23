<?php
header('content-type:text/html;charset=utf-8');
$password = "admin123";
$passwd = $_POST["password"];
if ( $passwd == $password)
{
   class MyDB extends SQLite3
   {
      function __construct()
      {
         $this->open('user.db');
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
   echo "<script type='text/javascript'>alert('创建数据库成功');
   location.href='admin.html';
   </script>";
}
else {
   echo "<script type='text/javascript'>alert('密码错误');
   location.href='admin.html';
   </script>";
}
?>