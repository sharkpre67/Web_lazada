<?php
$servername = "localhost";
$username = "minhkha"; // Thay bằng username của bạn
$password = "Minhkha@123"; // Thay bằng password của bạn
$dbname = "lazada_db"; // Thay bằng tên database của bạn

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
  die("Kết nối thất bại: " . $conn->connect_error);
}
?>