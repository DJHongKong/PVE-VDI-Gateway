<?php
header('content-type:text/html;charset=utf-8');
$username = "admin"; #管理员账号
$password = "admin123"; #管理员密码
$user = $_POST["user"];
$passwd = $_POST["password"];
if ($user == $username)
    {
        echo "user ok";
        if ($passwd == "$password")
        {
            setcookie("user","admin",time()+900);
             header('location:userList.php');
        }
        else
        {
        echo "<script type='text/javascript'>alert('登录失败，用户名或密码错误');
        location.href='admin.html';
        </script>";
        }
    }
else
{
    echo "<script type='text/javascript'>alert('登录失败，用户名或密码错误');
    location.href='admin.html';
    </script>";
}
?>