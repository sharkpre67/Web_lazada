<?php
// Cho phép truyền SID qua URL
//ini_set('session.use_trans_sid', 1);

// Không bắt buộc phải sử dụng cookie
//ini_set('session.use_only_cookies', 0);

session_start();
// Giả lập việc lấy dữ liệu người dùng từ cơ sở dữ liệu.
// Trong thực tế, bạn sẽ truy vấn CSDL để lấy tên người dùng đã đăng nhập.
if (isset($_SESSION["name"])) 
    $ho_ten_nguoi_dung = $_SESSION["name"];

// Một email ví dụ để hiển thị dạng che một phần
$email_vi_du = "*********@gmail.com";

// Hàm để che một phần email
function che_email($email) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        list($user, $domain) = explode('@', $email);
        $user_len = strlen($user);
        // Che ký tự ở giữa, chỉ hiện 2 ký tự đầu và 1 ký tự cuối
        $masked_user = substr($user, 0, 2) . str_repeat('*', $user_len - 3) . substr($user, -1);
        return $masked_user . '@' . $domain;
    }
    return $email;
}

$email_da_che = che_email($email_vi_du);

?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin cá nhân</title>
    <style>
        /* --- General Styling --- */
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background-color: #f4f5f7;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /* --- Container --- */
        .container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            width: 100%;
            max-width: 900px;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 30px;
            font-weight: 600;
            color: #172b4d;
        }

        /* --- Profile Grid --- */
        .profile-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr); /* 3 cột bằng nhau */
            gap: 30px 40px; /* Khoảng cách giữa các hàng và cột */
            margin-bottom: 40px;
        }

        .field {
            display: flex;
            flex-direction: column;
        }

        .field label {
            font-size: 14px;
            color: #6b778c;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .field .value, .field .placeholder {
            font-size: 16px;
            color: #172b4d;
            font-weight: 400;
        }
        
        .field .placeholder {
            color: #888; /* Màu cho chữ giữ chỗ */
        }
        
        .field a {
            color: #007bff;
            text-decoration: none;
            font-weight: 500;
        }
        
        .field a:hover {
            text-decoration: underline;
        }

        /* --- Actions --- */
        .actions {
            display: flex;
            gap: 15px; /* Khoảng cách giữa 2 nút */
            margin-top: 20px;
        }

        .btn {
            padding: 12px 25px;
            font-size: 14px;
            font-weight: 600;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            text-transform: uppercase;
            color: #ffffff;
            background-color: #00829B; /* Màu xanh mòng két */
            transition: background-color 0.2s ease;
        }
        
        .btn:hover {
            background-color: #00697d; /* Màu đậm hơn khi hover */
        }

        /* --- Checkbox --- */
        .email-prefs {
            margin-top: 10px;
            display: flex;
            align-items: center;
            font-size: 14px;
        }

        .email-prefs input[type="checkbox"] {
            margin-right: 8px;
        }

    </style>
</head>
<body>

<div class="container">
    <h1>Thông tin cá nhân</h1>

    <div class="profile-grid">
        <div class="field">
            <label>Họ tên</label>
            <div class="value"><?php echo htmlspecialchars($ho_ten_nguoi_dung); ?></div>
        </div>

        <div class="field">
            <label>Địa chỉ email | <a href="#">Thay đổi</a></label>
            <div class="value"><?php echo htmlspecialchars($email_da_che); ?></div>
            <div class="email-prefs">
                <input type="checkbox" id="promo-email">
                <label for="promo-email">Nhận thông tin ưu đãi qua email</label>
            </div>
        </div>

        <div class="field">
            <label>Số điện thoại | <a href="#">Thêm</a></label>
            <div class="placeholder">Vui lòng nhập số điện thoại của bạn</div>
        </div>

        <div class="field">
            <label>Ngày sinh</label>
            <div class="placeholder">Vui lòng nhập sinh nhật của bạn</div>
        </div>

        <div class="field">
            <label>Giới tính</label>
            <div class="placeholder">Nhập giới tính của bạn</div>
        </div>

        <div class="field">
            <label>Mã số thuế</label>
            <div class="placeholder">Nhập mã số thuế của bạn</div>
        </div>
    </div>

    <div class="actions">
        <button class="btn">Sửa thông tin</button>
        <button class="btn">Thay đổi mật khẩu</button>
    </div>

</div>

</body>
</html>