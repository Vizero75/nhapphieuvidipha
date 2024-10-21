<?php
session_start();
require_once __DIR__ . '/../config/database.php';

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if (isset($_GET['sid'])) {
    $voucher_id = htmlspecialchars($_GET['sid'], ENT_QUOTES, 'UTF-8');
    $user_id = $_SESSION['user_id']; // Lấy ID người dùng từ phiên

    // Kết nối cơ sở dữ liệu
    $conn = sqlsrv_connect($serverName, $connectionOptions);

    if ($conn === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    // Cập nhật trạng thái của phiếu quà tặng và lưu user_id
    $update_sql = "UPDATE Giftvouchers SET TrangThai = 'đã xác nhận', user_id = ? WHERE VoucherID = ?";
    $params = array($user_id, $voucher_id);
    $stmt = sqlsrv_query($conn, $update_sql, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    // Giải phóng tài nguyên và đóng kết nối
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);

    // Chuyển hướng người dùng về trang dashboard với thông báo thành công và voucher ID
    header('Location: dashboard.php?status=success&voucher_id=' . urlencode($voucher_id));
    exit;
} else {
    // Nếu không có `sid` trong URL, chuyển hướng về trang dashboard với thông báo lỗi
    header('Location: dashboard.php?status=error');
    exit;
}

