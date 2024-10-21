<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thông Tin Phiếu Quà Tặng</title>
    <link rel="stylesheet" href="/public/css/styles.css">
</head>
<body>
    <h1>Thông Tin Phiếu Quà Tặng</h1>
    
    <?php if (isset($voucherData)) : ?>
        <p><strong>Mã Phiếu Thông Tin:</strong> <?php echo $voucherData['MaPhieuThongTin']; ?></p>
        <p><strong>Tên Cơ Sở Bán Lẻ:</strong> <?php echo $voucherData['TenCoSoBanLe']; ?></p>
        <p><strong>Số Điện Thoại:</strong> <?php echo $voucherData['SoDienThoai']; ?></p>
        <p><strong>Ngày Phát Hành:</strong> <?php echo $voucherData['NgayPhatHanh']->format('Y-m-d'); ?></p>
        <p><strong>Hạn Sử Dụng:</strong> <?php echo $voucherData['HanSuDung']->format('Y-m-d'); ?></p>
        <p><strong>Trạng Thái:</strong> <?php echo $voucherData['TrangThai']; ?></p>
        <p><strong>Tên Chủ Tài Khoản:</strong> <?php echo $voucherData['TenChuTaiKhoan']; ?></p>
        <p><strong>Tên Ngân Hàng:</strong> <?php echo $voucherData['TenNganHang']; ?></p>
        <p><strong>Số Tài Khoản:</strong> <?php echo $voucherData['SoTaiKhoan']; ?></p>
        <p><strong>Địa Chỉ Nơi Mua Sản Phẩm:</strong> <?php echo $voucherData['DiaChiMuaSanPham']; ?></p>
    <?php else : ?>
        <p>Không tìm thấy thông tin phiếu quà tặng.</p>
    <?php endif; ?>

</body>
</html>
