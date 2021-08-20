<?php
$port = $_GET['port'];
$creator = $_GET['creator'];

$users = json_decode(file_get_contents("../../../../usr/local/shadowsocksr/mudb.json"), true);
//$result = [];
if($creator == "SUDO"){
    foreach ($users as $key => $user) {
        if ($user["port"] == $port && $user["enable"] == 1) {
            $users[$key]["enable"] = 0;
            file_put_contents("../../../../usr/local/shadowsocksr/mudb.json", json_encode($users));
            $status = "OK";
        }
    }
}else{
    foreach ($users as $key => $user) {
        if ($user["port"] == $port && $user["creator"] == $creator && $user["enable"] == 1) {
            $users[$key]["enable"] = 0;
            file_put_contents("../../../../usr/local/shadowsocksr/mudb.json", json_encode($users));
            $status = "OK";
        }
    }
}
if (is_null($status)) {
    $status = "NOK";
}
$result["status"] = $status;
echo(json_encode($result,true));
