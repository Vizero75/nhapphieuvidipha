<?php
session_start();
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/models/UserModel.php';

$error = '';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $userModel = new UserModel();
    $user = $userModel->getUserByUsername($username);

    if ($user) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            header('Location: dashboard.php');
            exit;
        } else {
            $error = 'Mật khẩu không chính xác.';
        }
    } else {
        $error = 'Tên người dùng không tồn tại.';
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập Nhân viên</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h2>Đăng Nhập Nhân Viên</h2>
        <?php if ($error): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="POST" action="login.php">
            <label for="username">Tên Người Dùng:</label>
            <input type="text" id="username" name="username" required><br><br>
            <label for="password">Mật Khẩu:</label>
            <input type="password" id="password" name="password" required><br><br>
            <button type="submit" name="login">Đăng Nhập</button>
        </form>
    </div>
</body>
</html>
