<?php
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
$sql = "SELECT ID,USERNAME,VMID,NODE FROM user";
$result = $db->query($sql);
while ($row = $result->fetchArray())
{
    $rows[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>云桌面管理后台</title>
    <style>
        @font-face
        {
        font-family: simhei;
        src: url('../font/simhei.ttf'),
        }
        body {
            font-family: simhei;
            background: #00a4f0;
        }
        
        div {
            width: 800px;
            margin: 6% auto;
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: rgba(255, 255, 255, 0.3);
            border-radius: 25px;
        }
        table{
            margin: 0 auto;
        }
        h2{
            margin-top: 10%;
            text-align: center;
        }
        tr{
            width: 300px;
        }
        td{
            width: 200px;
            height: 40px;
            font-size: 20px;
            text-align: center;
            color: #003e5b;
        }
        
        .addbtn {
            width: 210px;
            height: 50px;
            margin: 40px 0 auto auto;
            font-size: 20px;
            display: block;
            color: #003e5b;
            text-decoration: none;
            border: rgba(0, 62, 91, 0.8);
            border-radius: 15px;
            background-color: rgba(0, 62, 91, 0.3);
        }
        
        .input {
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <h2>用户列表</h2>
    <div>
    <table>
        <tr><tr>
            <td>编号</td>
            <td>用户名</td>
            <td>vmid</td>
            <td>节点</td>
            <td>操作</td>
        </tr>
        <!-- 先一行一行取出 放进对应的属性 -->
        <?php $i=1;foreach ($rows as $row):?>
            <tr>
                <td><?php echo $row[0];?></td>
                <td><?php echo $row[1];?></td>
                <td><?php echo $row[2];?></td>
                <td><?php echo $row[3];?></td>
                <td>
                    <!--<a href="editUser.php?act=ediUser&id=<?php echo $row['0']?>">更新</a>-->
                    <a href="doAction.php?act=delUser&id=<?php echo $row['0']?>">删除</a>
                </td>
            </tr>
        <?php endforeach;?>
            <tr>
                <td colspan="3">
                    <a href="addUser.php" class="addbtn">添加用户</a>
                </td>
            </tr>
    </table>
    </div>
</body>
</html>