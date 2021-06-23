<?php
header('content-type:text/html;charset=utf-8');
header('location:index.php');
if ($_COOKIE["user"] == "admin" )
{}
else
{
    echo "<script type='text/javascript'>alert('登录过期，请重新登录');
    location.href='admin.html';
    </script>";
}
class MyDB extends SQLite3
{
   function __construct()
   {
      $this->open('user.db');
   }
}
$db = new MyDB();
$id = $_GET['id'];
$sql = "SELECT ID,USERNAME,VMID,NODE FROM user WHERE ID = $id";
$result = $db->query($sql);
if ($result && $result->num_rows>0){
    while ($row = $result->fetchArray())
    {
    $rows[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h2>编辑用户</h2>
<form action="doAction.php?act=editUser&id=<?php echo $row[0]?>" method="post">
    <table border="1" cellpadding="0" cellspacing="0" bgcolor="#ABCDEF" width="80%">
        <tr>
            <td>用户名</td>
            <td><input type="text" name="username" id="username" placeholder="请输入用户名" required="required" value="<?php echo $row[1]?>"/></td>
        </tr>
        <tr>
            <td>密码</td>
            <td><input type="password" name="password" id="password" placeholder="请输入密码" required="required" /></td>
        </tr>
        <tr>
            <td>vmid</td>
            <td><input type="number" name="vmid" id="vmid"placeholder="请输入vmid" required="required" value="<?php echo $row[3]?>"/></td>
        </tr>
        <tr>
            <td>节点</td>
            <td><input type="text" name="node" id="node"placeholder="请输入节点" required="required" value="<?php echo $row[4]?>"/></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" value="更新用户" /></td>
        </tr>
    </table>
</form>
</body>
</html>