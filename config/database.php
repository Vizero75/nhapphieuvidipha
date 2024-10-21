<?php
$serverName = "DESKTOP-F8M9BRP"; // Tên máy chủ
$connectionOptions = array(
    "Database" => "Quanlyphieu",
    "Uid" => "sa",
    "PWD" => "vidipha1"
);

// Kết nối đến SQL Server
$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}
?>
