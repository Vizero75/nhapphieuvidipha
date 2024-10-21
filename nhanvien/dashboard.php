<?php
session_start();
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/models/VoucherModel.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$voucherModel = new VoucherModel();
$data = $voucherModel->getAllVouchers();

// Hiển thị thông báo sau khi duyệt thành công
if (isset($_GET['status']) && $_GET['status'] == 'success' && isset($_GET['voucher_id'])) {
    echo '<div class="alert alert-success">Bạn đã duyệt thành công phiếu có mã: ' . htmlspecialchars($_GET['voucher_id'], ENT_QUOTES, 'UTF-8') . '</div>';
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý dữ liệu Nhân viên</title>
    <!-- Latest compiled and minified CSS for Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
 
    <!-- Bootstrap 5 JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>

    <script>
        // JavaScript để lọc dữ liệu trong bảng
        function searchTable() {
            var input, filter, table, tr, td, i, j, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toLowerCase();
            table = document.getElementById("voucherTable");
            tr = table.getElementsByTagName("tr");

            for (i = 1; i < tr.length; i++) { // Bắt đầu từ 1 để bỏ qua tiêu đề
                tr[i].style.display = "none"; // Ẩn hàng mặc định
                td = tr[i].getElementsByTagName("td");
                for (j = 0; j < td.length; j++) {
                    if (td[j]) {
                        txtValue = td[j].textContent || td[j].innerText;
                        if (txtValue.toLowerCase().indexOf(filter) > -1) {
                            tr[i].style.display = ""; // Hiển thị hàng nếu có kết quả phù hợp
                            break; // Ngừng kiểm tra các cột khác trong cùng một hàng
                        }
                    }
                }
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Quản Lý Dữ Liệu</h2>

        <!-- Trường tìm kiếm -->
        <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Tìm kiếm phiếu..." class="form-control mb-3">
            
        <table id="voucherTable" class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Mã Phiếu Thông Tin</th>
                    <th>Tên Cơ Sở Bán Lẻ</th>
                    <th>Số Điện Thoại</th>
                    <th>Tên Chủ Tài Khoản</th>
                    <th>Tên Ngân Hàng</th>
                    <th>Số Tài Khoản</th>
                    <th>Trạng Thái</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($data)): ?>
                    <?php foreach ($data as $row): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['MaPhieuThongTin']); ?></td>
                    <td><?php echo htmlspecialchars($row['TenCoSoBanLe']); ?></td>
                    <td><?php echo htmlspecialchars($row['SoDienThoai']); ?></td>
                    <td><?php echo htmlspecialchars($row['TenChuTaiKhoan']); ?></td>
                    <td><?php echo htmlspecialchars($row['TenNganHang']); ?></td>
                    <td><?php echo htmlspecialchars($row['SoTaiKhoan']); ?></td>
                    <td><?php echo htmlspecialchars($row['TrangThai']); ?></td>
                    <td>
                        <?php 
                        // Kiểm tra các trường bắt buộc
                        if (!empty($row['TenCoSoBanLe']) && 
                            !empty($row['SoDienThoai']) && 
                            !empty($row['TenChuTaiKhoan']) && 
                            !empty($row['TenNganHang']) && 
                            !empty($row['SoTaiKhoan']) && 
                            !empty($row['TrangThai'])): 
                        ?>
                            <?php if ($row['TrangThai'] == 'đã xác nhận'): ?>
                                <a class="btn btn-secondary disabled">Liên hệ với admin</a>
                            <?php else: ?>
                                <a onclick="return confirm('Bạn có muốn xác nhận duyệt dữ liệu này?');" href="xacnhan.php?sid=<?php echo htmlspecialchars($row['VoucherID'], ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-success">Xác nhận duyệt</a>
                            <?php endif; ?>
                        <?php else: ?>
                            <span class="text-danger">Phiếu chưa sử dụng</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8">Không có dữ liệu để hiển thị</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
