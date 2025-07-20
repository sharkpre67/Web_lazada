<?php
//ini_set('session.use_trans_sid', 1);

// Không bắt buộc phải sử dụng cookie
//ini_set('session.use_only_cookies', 0);
// Bắt đầu session ở đầu file
session_start();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lazada - Mua Sắm Hàng Chất Giá Tốt</title>
    <link rel="stylesheet" href="style_index.css">
</head>
<body>

    <!-- 1. Thanh điều hướng trên cùng -->
    <nav class="top-nav">
        <div class="container">
            <ul>
                <li><a href="#">FEEDBACK</a></li>
                <li><a href="#">SAVE MORE ON APP</a></li>
                <li><a href="#">SELL ON LAZADA</a></li>
                <li><a href="#">CUSTOMER CARE</a></li>
                <li><a href="#">TRACK MY ORDER</a></li>
                <?php if (isset($_SESSION['name'])): ?>
                    <!-- Nếu người dùng đã đăng nhập -->
                    <li><a href="logout.php">LOGOUT</a></li>
                <?php else: ?>
                    <!-- Nếu người dùng chưa đăng nhập -->
                    <li><a href="login.php">LOGIN</a></li>
                    <li><a href="register.php">SIGNUP</a></li>
                <?php endif; ?>
                <li><a href="#">CHANGE LANGUAGE</a></li>
            </ul>
        </div>
    </nav>

    <!-- 2. Header chính với Logo, Tìm kiếm, Giỏ hàng -->
    <header class="main-header">
        <div class="container">
            <div class="logo">
                <a href="index.php"><img src="https://inkythuatso.com/uploads/images/2021/09/lazada-logo-inkythuatso-14-11-38-31.jpg" alt="Lazada"></a>
            </div>
            <div class="search-bar">
                <input type="text" placeholder="Tìm kiếm trên Lazada">
                <button>&#128269;</button>
            </div>
            <div class="cart-and-promo">
                <span class="cart-icon">&#128722;</span>
                <img src="https://img.alicdn.com/tfs/TB1_r.hY_tYBeNjy1XdXXXXyVXa-750-200.png" alt="Promo" class="promo-banner">
            </div>
        </div>
    </header>

    <!-- 3. Nội dung chính -->
    <main class="container">
        <div class="main-content-area">
            <!-- Banner không tràn màn hình -->
            <section class="hero-banner">
                <img src="https://img.lazcdn.com/us/domino/6de775a7-f498-4422-9942-2b2fca579cbd_VN-1976-688.jpg_2200x2200q80.jpg" alt="Nhà Sang Xế Xịn">
            </section>

            <!-- Thông tin người dùng kế bên banner (chỉ hiện khi đăng nhập) -->
            <?php if (isset($_SESSION['name'])): ?>
            <aside class="user-info-panel">
                <h3>Thông tin tài khoản</h3>
                <p><strong>Xin chào,</strong></p>
                <p class="display-name"><?php echo htmlspecialchars($_SESSION['name']); ?></p>
                <p>Chào mừng bạn đã quay trở lại!</p>
                <a href="profile.php" class="my-account-btn">Quản lý tài khoản</a>
            </aside>
            <?php endif; ?>
        </div>

        <div class="more-options">
             <div class="option">
                <img src="https://img.lazcdn.com/us/domino/901aecdc-e8dc-4bf2-9464-476f799a8200_VN-276-260.png_300x300q80.png" alt="LazMall Icon">
                <p>LazMall</p>
                <span>100% Hàng Chính Hãng</span>
            </div>
             <div class="option">
                <img src="https://img.lazcdn.com/us/domino/52eea06f-896c-4e21-a3b8-9b681e4485a5_VN-276-260.png_300x300q80.png" alt="Voucher Icon">
                <p>Voucher</p>
                <span>Collect & Redeem Now!</span>
            </div>
             <div class="option">
                <img src="https://img.lazcdn.com/us/domino/81ab3f69-2391-4129-88d7-d285aa0ffd93_VN-276-260.png_300x300q80.png" alt="Top Up Icon">
                <p>Top Up</p>
                <span>Cheap Mobile & 4G TopUp!</span>
            </div>
        </div>
    </main>

</body>
</html>
