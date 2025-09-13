<?php
// اتصال به پایگاه داده
$conn = new mysqli("localhost", "root", "zahra123", "chefsho", 3307); 

if ($conn->connect_error) {
    die("اتصال به پایگاه داده ناموفق بود: " . $conn->connect_error);
}

// گرفتن داده‌های فرم
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm = $_POST['confirm-password'];

// بررسی یکسان بودن رمزها
if ($password !== $confirm) {
    die("رمز عبور و تایید آن یکسان نیستند.");
}

// هش کردن رمز عبور
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// افزودن به پایگاه داده
$sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $username, $email, $hashed_password);

if ($stmt->execute()) {
    echo "ثبت‌نام با موفقیت انجام شد!";
} else {
    echo "خطا در ثبت‌نام: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>