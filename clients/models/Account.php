<?php

// models/User.php
class User {
    public $name;
    public $email;
    private $pdo;

    // Khởi tạo với dữ liệu người dùng và kết nối CSDL
    public function __construct($data, $pdo = null) {
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->pdo = $pdo;
    }

    // Lấy mật khẩu của người dùng từ CSDL
    public function getPassword($userId) {
        $stmt = $this->pdo->prepare("SELECT password FROM users WHERE id = :id");
        $stmt->execute(['id' => $userId]);
        return $stmt->fetchColumn();
    }

    // Cập nhật mật khẩu người dùng
    public function updatePassword($userId, $newPassword) {
        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT); // Mã hóa mật khẩu mới
        $stmt = $this->pdo->prepare("UPDATE users SET password = :password, updated_at = NOW() WHERE id = :id");
        $stmt->execute(['password' => $hashedPassword, 'id' => $userId]);
    }

    // Các phương thức khác liên quan đến người dùng có thể được thêm vào đây
}
