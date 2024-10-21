<?php
require_once __DIR__ . '/../config/database.php';

// Thông tin người dùng mẫu
$username = 'employee3';
$password = '1';

// Băm mật khẩu trước khi lưu
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Câu lệnh SQL để thêm người dùng
$sql = "INSERT INTO Users (username, password) VALUES (?, ?)";
$params = array($username, $hashed_password);

// Thực hiện truy vấn
$stmt = sqlsrv_query($conn, $sql, $params);

// Kiểm tra kết quả
if ($stmt) {
    echo "Người dùng đã được thêm thành công!";
} else {
    echo "Lỗi: " . print_r(sqlsrv_errors(), true);
}
?>
