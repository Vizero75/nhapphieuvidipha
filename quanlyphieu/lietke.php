<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liệt kê</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class = "container">
        <h1>Danh sách </h1>
    <table class="table">
    <thead class="thead-dark">
      <tr>
        <th>Mã sinh viên</th>
        <th>Họ Tên</th>
        <th>Lớp</th>
        <th>Thao tác</th>
      </tr>
    </thead>
    <tbody>
    <?php
    // Kết nối
    require_once 'ketnoi.php'; 

    // Câu lệnh SQL
    $lietke_sql = "SELECT * FROM sinhvien ORDER BY lop, hoten";

    // Thực thi câu lệnh
    $result = sqlsrv_query($conn, $lietke_sql);

    if ($result === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    // Duyệt qua result và in ra
    while ($r = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
    ?>
    <tr>
    <td><?php echo $r['masv']; ?></td>
    <td><?php echo $r['hoten']; ?></td>
    <td><?php echo $r['lop']; ?></td>
    <td>
        <a href="edit.php?sid=<?php echo $r['id']; ?>" class="btn btn-info">Sửa</a>
        <a onclick="return confirm('Bạn có muốn xóa dòng này?');" href="xoa.php?sid=<?php echo $r['id']; ?>" class="btn btn-danger">Xóa</a>
    </td>
    </tr>
    <?php
    }

    // Đóng kết nối
    sqlsrv_free_stmt($result);
    sqlsrv_close($conn);
    ?>
     </tbody>
     </table>
     </div>
</body>
</html>
