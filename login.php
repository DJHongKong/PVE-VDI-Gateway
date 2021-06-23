<?php
header('content-type:text/html;charset=utf-8');
$server = '127.0.0.1'; #PVE节点IP
$serverusername = 'root@pam'; #PVE账号
$serverpassword = 'password'; #PVE密码
$inputusername = $_POST["username"];
$inputpassword = $_POST["password"];
class MyDB extends SQLite3
{
   function __construct()
   {
      $this->open('admin/user.db');
   }
}
$db = new MyDB();
$sql = "SELECT PASSWORD,VMID,NODE FROM user WHERE USERNAME = '$inputusername'";
$result = $db->query($sql);
while ($row = $result->fetchArray())
{
    $rows[] = $row;
}
$i=1;
foreach ($rows as $row):
$sqlpassword = $row[0];
$sqlvmid = $row[1];
$sqlnode = $row[2];
endforeach;
$node = $sqlnode;
$vmid = $sqlvmid;
if($inputpassword == $sqlpassword)
{
    $ticketapiurl =  "https://$server:8006/api2/json/access/ticket";
    $spiceapiurl =  "https://$server:8006/api2/json/nodes/$node/qemu/$vmid/spiceproxy";
    $data = array('username'=>$serverusername,'password'=>$serverpassword);
    $requestBody = http_build_query($data);
    $ticketcontext = stream_context_create(['http' => ['method' => 'POST', 'header' => "Content-Type: application/x-www-form-urlencoded\r\n"."Content-Length: " . mb_strlen($requestBody), 'content' => $requestBody]]);
    $ticketresponse = @file_get_contents($ticketapiurl,false,$ticketcontext);
    $ticketdata = json_decode($ticketresponse,true);
    $ticketdata1 = json_encode($ticketdata['data'],true);
    $ticketdata2 = json_decode($ticketdata1,true);
    $CSRFPreventionToken = $ticketdata2['CSRFPreventionToken'];
    $ticket = $ticketdata2['ticket'];
    $spicecontext = stream_context_create(['http' => ['method' => 'POST', 'header' => "Content-Type: application/x-www-form-urlencoded\r\n"."Content-Length: 0\r\n"."Cookie: PVEAuthCookie=$ticket\r\n"."CSRFPreventionToken: $CSRFPreventionToken\r\n"]]);
    $spiceresponse = @file_get_contents($spiceapiurl,false,$spicecontext);
    $spicedata = json_decode($spiceresponse,true);
    $spicedata1 = json_encode($spicedata['data'],true);
    $spicedata2 = json_decode($spicedata1,true);
    unlink('temp/spice.vv');
    $vvflie = fopen("temp/spice.vv", "w");
    $hostsubject = $spicedata2["host-subject"];
    $type = $spicedata2["type"];
    $password = $spicedata2["password"];
    $releasecursor = $spicedata2["release-cursor"];
    $proxy = $spicedata2["proxy"];
    $tlsport = $spicedata2["tls-port"];
    $title = $spicedata2["title"];
    $ca = $spicedata2["ca"];
    $secureattention = $spicedata2["secure-attention"];
    $host = $spicedata2["host"];
    $togglefullscreen = $spicedata2["toggle-fullscreen"];
    $header = "[virt-viewer]\n";
    fwrite($vvflie, $header);
    $writetext = "host-subject=$hostsubject\n";
    fwrite($vvflie, $writetext);
    $writetext = "type=$type\n";
    fwrite($vvflie, $writetext);
    $writetext = "password=$password\n";
    fwrite($vvflie, $writetext);
    $writetext = "release-cursor=$releasecursor\n";
    fwrite($vvflie, $writetext);
    $writetext = "proxy=$proxy\n";
    fwrite($vvflie, $writetext);
    $writetext = "delete-this-file=1\n";
    fwrite($vvflie, $writetext);
    $writetext = "tls-port=$tlsport\n";
    fwrite($vvflie, $writetext);
    $writetext = "title=$title\n";
    fwrite($vvflie, $writetext);
    $writetext = "ca=$ca\n";
    fwrite($vvflie, $writetext);
    $writetext = "secure-attention=$secureattention\n";
    fwrite($vvflie, $writetext);
    $writetext = "host=$host\n";
    fwrite($vvflie, $writetext);
    $writetext = "toggle-fullscreen=$togglefullscreen";
    fwrite($vvflie, $writetext);
    fclose($vvflie);
    header('location:temp/spice.vv');
    header('login.html');
}
else
{
    echo "<script type='text/javascript'>alert('登录失败，用户名或密码错误');
    location.href='login.html';
    </script>";
}
?>