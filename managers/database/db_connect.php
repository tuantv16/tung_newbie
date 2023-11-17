<?php

$servername = "localhost"; // Tên server MySQL
$username = "root"; // Tên người dùng MySQL
$password = ""; // Mật khẩu người dùng MySQL
$dbname = "db_new_project"; // Tên cơ sở dữ liệu
$port = 3306; // Số cổng MySQL của bạn

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
} 

// else {
//     echo "Kết nối thành công";
// }
?>