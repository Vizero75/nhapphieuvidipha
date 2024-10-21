<?php
// Lấy dữ liệu id cần xóa
$id = isset($_GET['sid']) ? intval($_GET['sid']) : 0;

if ($id <= 0) {
    die("ID không hợp lệ.");
}

// Kết nối
require_once 'ketnoi.php';

// Câu lệnh SQL với tham số
$xoa_sql = "DELETE FROM sinhvien WHERE id = ?";

// Chuẩn bị và thực thi câu lệnh
$params = array($id);
$stmt = sqlsrv_query($conn, $xoa_sql, $params);

//if ($stmt === false) {
//    die(print_r(sqlsrv_errors(), true));
//} else {
//    echo "<h1>Xóa thành công</h1>";
//}
header("Location: lietke.php");
// Đóng kết nối
sqlsrv_close($conn);
?>
