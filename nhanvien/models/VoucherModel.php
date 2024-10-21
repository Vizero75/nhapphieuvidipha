<?php
class VoucherModel {
    private $conn;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }

    public function getAllVouchers() {
        $sql = "SELECT * FROM GiftVouchers";
        $stmt = sqlsrv_query($this->conn, $sql);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        $vouchers = [];
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $vouchers[] = $row;
        }

        return $vouchers;
    }
}
?>
