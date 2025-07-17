<?php
require 'config.php';

$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $name = $_POST['name']; // Lấy dữ liệu từ trường name mới
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $error = 'Mật khẩu không khớp!';
    } else {
        // Kiểm tra username đã tồn tại chưa
        $sql_check = "SELECT id FROM users WHERE username = ?";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->bind_param("s", $username);
        $stmt_check->execute();
        $stmt_check->store_result();

        if ($stmt_check->num_rows > 0) {
            $error = 'Tên đăng nhập đã tồn tại!';
        } else {
            // Mã hóa mật khẩu
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Cập nhật câu lệnh INSERT để thêm cả 'name'
            $sql_insert = "INSERT INTO users (username, name, password) VALUES (?, ?, ?)";
            $stmt_insert = $conn->prepare($sql_insert);
            // bind_param bây giờ có 3 tham số: "sss" (string, string, string)
            $stmt_insert->bind_param("sss", $username, $name, $hashed_password);

            if ($stmt_insert->execute()) {
                $success = 'Đăng ký thành công! Bạn có thể <a href="login.php">đăng nhập</a> ngay bây giờ.';
            } else {
                $error = 'Đã có lỗi xảy ra, vui lòng thử lại.';
            }
            $stmt_insert->close();
        }
        $stmt_check->close();
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="auth-body">
    <div class="auth-container">
        <div class="auth-header">
            <span class="auth-title active">Register</span>
            <a href="index.php" class="close-btn">&times;</a>
        </div>
        <form class="auth-form" method="POST" action="register.php">
            <?php if($error): ?>
                <p class="error-message"><?php echo $error; ?></p>
            <?php endif; ?>
            <?php if($success): ?>
                <p class="success-message"><?php echo $success; ?></p>
            <?php endif; ?>

            <!-- Thêm trường nhập liệu cho Tên đầy đủ -->
            <input type="text" name="name" placeholder="Enter your Full Name" required>
            <input type="text" name="username" placeholder="Enter your Phone or Email" required>
            <input type="password" name="password" placeholder="Enter your password" required>
            <input type="password" name="confirm_password" placeholder="Confirm your password" required>

            <button type="submit" class="auth-btn">SIGN UP</button>
            <p class="auth-switch">Already have an account? <a href="login.php">Login</a></p>
        </form>
    </div>
</body>
</html>
