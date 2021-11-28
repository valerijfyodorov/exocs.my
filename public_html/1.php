<?php

$servername = "localhost";
$username = "mysql";
$password = "";
$dbname = "ocs";
$link = mysqli_connect($servername, $username, $password, $dbname); // подключение

// проверка
if (!$link) {
    echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
    exit;
}

$sql =mysqli_query($link,' SELECT hardware.lastdate,accountinfo.TAG 
                                FROM hardware
                                INNER JOIN accountinfo ON hardware.ID=accountinfo.HARDWARE_ID');

    while ($result = mysqli_fetch_array($sql)) {
        $arr[$i] = $result;
   // echo "{$result['TAG']}|{$result['lastdate']} | {$arr[$i]['TAG']} |{$arr[$i]['lastdate']}<br>";
    $i++;
    }
    //exit();