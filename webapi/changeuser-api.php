<?php
$port = $_GET['port'];
$users = json_decode(file_get_contents("../../../../usr/local/shadowsocksr/mudb.json"), true);
$temp = 0;
foreach ($users as $user) {
    if ($user["port"] == $port) {
        $users[$temp]["passwd"] = uniqid();
        $users[$temp]["url"] = "ss://" .  base64_encode($users[$temp]["method"] . ":" . $users[$temp]["passwd"] . "@" . "s1.nitroping.ir:" . $users[$temp]["port"]);
        echo (json_encode($users[$temp], true));
        file_put_contents("../../../../usr/local/shadowsocksr/mudb.json", json_encode($users));
    }
    $temp++;
}

