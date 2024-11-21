    <?php
    // session_start();
    class Login
    {
        public $conn;

        public function __construct()
        {
            $this->conn = connectDB();
        }

        // Kiểm tra thông tin đăng nhập
        public function checkLogin($email, $password)
        {
            try {
                $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email");
                if (!$stmt) {
                    throw new Exception("Lỗi prepare statement: " . implode(", ", $this->conn->errorInfo()));
                }
        
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                $stmt->execute();
        
                if ($stmt->rowCount() > 0) {
                    $user = $stmt->fetch(PDO::FETCH_ASSOC);
                    // Kiểm tra mật khẩu trực tiếp
                    if ($password === $user['password']) {
                        $_SESSION['user'] = $user; // Lưu thông tin user vào session
                        return true;
                    } else {
                        $_SESSION['error'] = "Sai mật khẩu.";
                    }
                } else {
                    $_SESSION['error'] = "Email không tồn tại.";
                }
            } catch (Exception $e) {
                error_log($e->getMessage());
                $_SESSION['error'] = "Đã xảy ra lỗi trong hệ thống.";
            }
            return false;
        }
        

        // Tạo người dùng mới
        public function createUser($name, $email, $password, $phone)
{
    try {
        // Kiểm tra email trùng lặp
        $stmtCheck = $this->conn->prepare("SELECT id FROM users WHERE email = :email");
        $stmtCheck->bindParam(':email', $email, PDO::PARAM_STR);
        $stmtCheck->execute();
        
        if ($stmtCheck->rowCount() > 0) {
            $_SESSION['error'] = "Email đã tồn tại. Vui lòng sử dụng email khác.";
            return false;
        }

        

        // Thêm người dùng mới
        $sql = "INSERT INTO users(name, email, password, phone) 
                VALUES (:name, :email, :password, :phone)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':password' => $password, // Lưu mật khẩu đã mã hóa
            ':phone' => $phone
        ]);

        // Nếu thành công
        $_SESSION['success'] = "Đăng ký thành công!";
        return true;
    } catch (Exception $e) {
        // Ghi nhật ký lỗi
        error_log($e->getMessage());
        $_SESSION['error'] = "Đã xảy ra lỗi trong hệ thống.";
        return false;
    }
}

        // Kiểm tra trạng thái đăng nhập
        public function isLoggedIn()
        {
            return isset($_SESSION['user']);
        }

        // Đăng xuất
        public function logout()
        {
            // Hủy session người dùng
            session_start();
            session_unset();  // Hủy tất cả các biến trong session
            session_destroy(); // Hủy session
    
            // Chuyển hướng người dùng về trang đăng nhập
            header("Location: ?act=login");
            exit();
        }
    }


