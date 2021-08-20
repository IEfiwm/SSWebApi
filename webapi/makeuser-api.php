<?php
$expiredate = $_GET['expiredate'];
$traffic = $_GET['traffic'];
$creator = $_GET['creator'];

if(is_null($creator)){
    $creator = "api";
}
if(is_null($expiredate)){
    $expiredate = date("Y/m/d", strtotime("+1 Months"));
} 
if(is_null($traffic)){
    $traffic = 40 * 1024 * 1024 * 1024;
}else{
    $traffic = $traffic * 1024 * 1024 * 1024;
}
$users = json_decode(file_get_contents("../../../../usr/local/shadowsocksr/mudb.json") , true);
foreach ($users as $key) {
    $user_ports = $key["port"] . "\n";
}
$ports = explode("\n" , $user_ports);
$count = count($users);
$index = $count+1;
$user["d"] = rand(0, 80000000);
$user["creator"] = $creator; // Creator
$user["enable"] = 1;
$user["forbidden_port"] = "";
$user["method"] = "chacha20-ietf";
$user["obfs"] = "plain";
$user["passwd"] = uniqid();
do {
    //$port = rand(60000,65353);
    $port = rand(2000,15000);
} while (in_array($port , $ports));
$user["port"] = $port;
$user["protocol"] = "origin";
$user["protocol_param"] = "1";
$user["speed_limit_per_con"] = 0;
$user["speed_limit_per_user"] = 0;
$user["transfer_enable"] = $traffic;
$user["u"] = rand(0, 80000000);
$user["user"] = "user0" . $user["port"];
$user["expiredate"] = $expiredate;
$users[$count] = $user;
$user["url"] = "ss://". base64_encode($user["method"] . ":" . $user["passwd"] . "@" . "s2.nitroping.ir:" . $user["port"]) ;//print_r($user);
echo(json_encode($user , true));
file_put_contents("../../../../usr/local/shadowsocksr/mudb.json", json_encode($users));

