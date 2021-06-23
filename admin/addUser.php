
<?php
if ($_COOKIE["user"] == "admin" )
{}
else
{
    echo "<script type='text/javascript'>alert('登录过期，请重新登录');
    location.href='admin.html';
    </script>";
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
        body {
            background: #00a4f0;
        }
        
        div {
            width: 400px;
            height: 340px;
            margin: 6% auto;
            padding-top: 40px;
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
            width: 64px;
        }
        td{
            height: 40px;
            font-size: 20px;
            text-align: center;
            color: #003e5b;
        }
        
        .addbtn {
            width: 210px;
            height: 40px;
            margin-top: 40px;
            font-size: 20px;
            color: #003e5b;
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
    <h2>添加用户</h2>
    <div>
    <form action="doAction.php?act=addUser" method="post">
        <table>
            <tr>
                <td>用户名</td>
                <td><input type="text" name="username" id="username" class="input"/></td>
            </tr>
            <tr>
                <td>密码</td>
                <td><input type="password" name="password" id="password" class=“input”/></td>
            </tr>
            <tr>
                <td>vmid</td>
                <td><input type="number" name="vmid" id="vmid" class="input"/></td>
            </tr>
            <tr>
            <td>节点</td>
            <td><input type="text" name="node" id="node" class="input"/></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="添加用户" class="addbtn"/></td>
            </tr>
        </table>
    </form>
    </div>
</body>
</html>