<?php
function dayRerouting($time2, $time1)
{
    $diff = strtotime($time2) - strtotime($time1);
    return round($diff / 86400, 0, 1);
}
$creator = $_GET["creator"];
$port = $_GET["port"];
$users = json_decode(file_get_contents("../../../../usr/local/shadowsocksr/mudb.json"), true);
$i = 0;
$result = [];
    foreach ($users as $user) {
        if ($user["enable"] == 1 && $user["creator"] == $creator && $user["port"] == $port) {
            $result["all_users"][$i] = $user;
            $i = $i + 1;
        }
    }

$result["total"] = $i;
echo (json_encode($result, true));

