<?php
// Nhận dữ liệu từ form
$ht = $_POST['hoten'];
$masv = $_POST['masv'];
$lop = $_POST['lop'];

// Kết nối CSDL
require_once 'ketnoi.php';

// Viết lệnh SQL để thêm dữ liệu
$themsql = "INSERT INTO sinhvien (masv, hoten, lop) VALUES (?, ?, ?)";

// Chuẩn bị và thực thi câu lệnh SQL
$params = array($masv, $ht, $lop);
$stmt = sqlsrv_query($conn, $themsql, $params);

// Kiểm tra và in thông báo thành công

header("Location: lietke.php");
// Đóng kết nối
sqlsrv_close($conn);
?>
