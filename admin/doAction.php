<?php
header('content-type:text/html;charset=utf-8');
if ($_COOKIE["user"] == "admin" )
{
    class MyDB extends SQLite3
    {
        function __construct()
    {
        $this->open('user.db');
   }
    }
    $db = new MyDB();
    if ($db->connect_errno){
        die($db->connect_error);
    }
    $username = $_POST['username'];
    $password = $_POST['password'];
    $vmid = $_POST['vmid'];
    $node = $_POST['node'];
    $act = $_GET['act'];
    $id = $_GET['id'];
    switch ($act){
        case 'addUser':
            $sql = "insert into user(USERNAME,PASSWORD,VMID,NODE) values ('$username','$password','$vmid','$node')";
            $res = $db->query($sql);
            if ($res){
                echo "<script type='text/javascript'>alert('添加用户成功');
                        location.href='userList.php';
                      </script>";
            }else{
                echo "<script type='text/javascript'>alert('添加用户失败，重新添加');
                        location.href='addUser.php';
                      </script>";
            }
            break;
        case 'delUser':
            $sql = "DELETE FROM user WHERE ID = $id";
            $res = $db->query($sql);
            if ($res){
                $mes = "删除成功";
            }else{
                $mes = "删除失败";
            }
            $usel = 'userList.php';
            echo "<script type='text/javascript'>alert('$mes');
                        location.href='$usel';
                      </script>";
            break;
        case 'editUser':
            $sql = "UPDATE user SET USERNAME = '$username',PASSWORD = '$password',VMID = '$vmid',NODE = $node where ID = $id";
            $res = $db->query($sql);
            if ($res){
                $mes = "更新成功";
            }else{
                $mes = "更新失败";
            }
            $usel = 'userList.php';
            echo "<script type='text/javascript'>alert('$mes');
                        location.href='$usel';
                      </script>";
            break;
    }
}
else
{
    echo "<script type='text/javascript'>alert('登录过期，请重新登录');
    location.href='admin.html';
    </script>";
}

?>