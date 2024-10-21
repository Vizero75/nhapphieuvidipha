<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/GiftVoucherSystem/config/database.php';

class VoucherModel {
    private $conn;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }

    public function getVoucherByCode($maPhieu) {
        $sql = "SELECT * FROM GiftVouchers WHERE MaPhieuThongTin = ?";
        $params = array($maPhieu);
        $stmt = sqlsrv_query($this->conn, $sql, $params);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        return sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    }

    public function updateVoucherDetails($maPhieu, $tenCoSo, $soDienThoai, $tenChuTaiKhoan, $tenNganHang, $soTaiKhoan, $diaChiMua) {
        $sql = "UPDATE GiftVouchers 
                SET TenCoSoBanLe = ?, SoDienThoai = ?, TenChuTaiKhoan = ?, TenNganHang = ?, SoTaiKhoan = ?, DiaChiMuaSanPham = ?, TrangThai = 'chờ xác nhận'
                WHERE MaPhieuThongTin = ? AND IsLocked = 0";
        $params = array($tenCoSo, $soDienThoai, $tenChuTaiKhoan, $tenNganHang, $soTaiKhoan, $diaChiMua, $maPhieu);
    
        // Debug: In ra các giá trị trước khi thực hiện truy vấn
        print_r($params);
    
        $stmt = sqlsrv_query($this->conn, $sql, $params);
    
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }
    }
    

    public function lockVoucher($maPhieu) {
        $sql = "UPDATE GiftVouchers SET IsLocked = 1 WHERE MaPhieuThongTin = ?";
        $params = array($maPhieu);
        $stmt = sqlsrv_query($this->conn, $sql, $params);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }
    }

    public function isVoucherLocked($maPhieu) {
        $sql = "SELECT IsLocked FROM GiftVouchers WHERE MaPhieuThongTin = ?";
        $params = array($maPhieu);
        $stmt = sqlsrv_query($this->conn, $sql, $params);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        $result = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        return $result['IsLocked'] == 1;
    }
}
?>
