<?php
if(file_exists("install.php"))
{
    header('location:install.php');
}
else
{
    header('location:login.html');
}
?>