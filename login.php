<?php
session_start();
require 'config.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            session_start();
			session_regenerate_id(true);
            $_SESSION['username'] = $username;
            $_SESSION['name'] = $user['name'];
            header("location: index.php");
            exit;
        } else {
            $error = 'Sai mật khẩu!';
        }
    } else {
        $error = 'Tên đăng nhập không tồn tại!';
    }
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="auth-body">
    <div class="auth-container">
        <div class="auth-header">
            <span class="auth-title active">Password</span>
            <span class="auth-title">Phone Number</span>
            <a href="index.php" class="close-btn">&times;</a>
        </div>
        <form class="auth-form" method="POST" action="login.php">
            <input type="text" name="username" placeholder="Please enter your Phone or Email" required>
            <div class="password-wrapper">
                <input type="password" name="password" placeholder="Please enter your password" required>
                <span class="toggle-password">&#128065;</span>
            </div>
            <?php if($error): ?>
                <p class="error-message"><?php echo $error; ?></p>
            <?php endif; ?>
            <a href="#" class="forgot-password">Forgot password?</a>
            <button type="submit" class="auth-btn">LOGIN</button>
            <p class="auth-switch">Don't have an account? <a href="register.php">Sign up</a></p>
            <div class="social-login">
                <p>Or, login with</p>
                <div class="social-buttons">
                    <a href="#" class="social-google">Google</a>
                    <a href="#" class="social-facebook">Facebook</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>