<?php
if ($_COOKIE["user"] == "admin" )
{
    header('userList.php');
}
else
{
    header('login.html');
}
?>