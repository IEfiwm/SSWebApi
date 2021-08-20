<?php
function dayRerouting($time2, $time1)
{
    $diff = strtotime($time2) - strtotime($time1);
    return round($diff / 86400, 0, 1);
}
$users = json_decode(file_get_contents("../../../../usr/local/shadowsocksr/mudb.json"),true);
foreach ($users as $key => $user) {
    if(!is_null($user["expiredate"])){
        if(dayRerouting($user["expiredate"] , date("Y/m/d")) == 0 && $user["enable"] == 1 || dayRerouting($user["expiredate"] , date("Y/m/d")) < 0 && $user["enable"] == 1){
            echo("Deleted");
            echo("<br>");
            $users[$key]["enable"] = 0; 
            echo("<br>");
            echo($user["user"]);
            echo("<br>");
            echo($user["port"]);
            echo("<br>");
            echo($user["expiredate"]);
            echo("<br>");
            echo("<br>");echo("<br>"); 
            file_put_contents("../../../../usr/local/shadowsocksr/mudb.json", json_encode($users));
        }
    }
}
