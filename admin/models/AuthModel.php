<?php
class Auth {
    private $db;

    public function __construct() {
        $this->db = new PDO("mysql:host=localhost;dbname=duan1", "root", "");
    }

    public function isAdmin() {
        if (!isset($_SESSION['admin_id'])) {
            return false;
        }
        
        try {
            $stmt = $this->db->prepare("SELECT role FROM users WHERE id = ? AND role = 'admin'");
            $stmt->execute([$_SESSION['admin_id']]);
            $user = $stmt->fetch();
            
            return $user !== false;
        } catch(PDOException $e) {
            return false;
        }
    }

    public function checkLogin() {
        return isset($_SESSION['admin_id']) && $this->isAdmin();
    }

    public function logout() {
        // Xóa tất cả các session liên quan
        unset($_SESSION['admin_id']);
        unset($_SESSION['admin_name']);
        unset($_SESSION['admin_role']);
        unset($_SESSION['is_logged_in']);
        unset($_SESSION['last_activity']);
        unset($_SESSION['admin_logged_in']);
        unset($_SESSION['admin_auth']);
        
        // Xóa session của client nếu cần
        unset($_SESSION['user']);
        
        // Hủy toàn bộ session
        session_destroy();
        
        // Xóa cookie session nếu có
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time()-3600, '/');
        }
        
        // Chuyển hướng về trang login
        header('Location: ?act=show-login-form');
        exit;
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            try {
                $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ? AND role = 'admin'");
                $stmt->execute([$email]);
                $admin = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if ($admin && password_verify($password, $admin['password'])) {
                    $_SESSION['admin_id'] = $admin['id'];
                    $_SESSION['admin_name'] = $admin['name'];
                    $_SESSION['admin_role'] = $admin['role'];
                    $_SESSION['is_logged_in'] = true;
                    $_SESSION['last_activity'] = time(); // Thêm timestamp
                    
                    header('Location: ./');
                    exit;
                } else {
                    $_SESSION['error'] = 'Email hoặc mật khẩu không đúng';
                    header('Location: ?act=show-login-form');
                    exit;
                }
            } catch(PDOException $e) {
                $_SESSION['error'] = 'Có lỗi xảy ra, vui lòng thử lại sau';
                header('Location: ?act=show-login-form');
                exit;
            }
        }
    }

    public function endSession() {
        // Xóa tất cả các session
        session_unset();
        session_destroy();
        
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time()-3600, '/');
        }
    }
}