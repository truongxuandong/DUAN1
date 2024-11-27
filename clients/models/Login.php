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
                    // Kiểm tra mật khẩu đã hash
                    if (password_verify($password, $user['password'])) {
                        return $user; // Trả về thông tin người dùng nếu đúng mật khẩu
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
            return false; // Trả về false nếu không tìm thấy hoặc lỗi
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

                // Hash password trước khi lưu vào database
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $defaultAvatar = 'default.jpg';

                // Thêm người dùng mới
                $sql = "INSERT INTO users(name, email, password, phone, avatar) 
                        VALUES (:name, :email, :password, :phone, :avatar)";
                $stmt = $this->conn->prepare($sql);
                
                if (!$stmt->execute([
                    ':name' => $name,
                    ':email' => $email,
                    ':password' => $hashedPassword,
                    ':phone' => $phone,
                    ':avatar' => $defaultAvatar
                ])) {
                    throw new Exception("Không thể thêm người dùng mới");
                }

                return true;
            } catch (Exception $e) {
                error_log($e->getMessage());
                $_SESSION['error'] = "Đã xảy ra lỗi khi đăng ký: " . $e->getMessage();
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


