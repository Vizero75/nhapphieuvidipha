<?php
require_once '../models/VoucherModel.php';

if (isset($_POST['submit'])) {
    $maPhieu = $_POST['ma_phieu'];

    $voucherModel = new VoucherModel();
    $voucherData = $voucherModel->getVoucherByCode($maPhieu);

    if ($voucherData) {
        // Cập nhật trạng thái
        $voucherModel->updateVoucherStatus($maPhieu, 'chờ xác nhận');
        // Hiển thị thông tin phiếu
        require_once '../views/voucher.php';
    } else {
        echo "Mã Phiếu Thông Tin không tồn tại.";
    }
}
?>
