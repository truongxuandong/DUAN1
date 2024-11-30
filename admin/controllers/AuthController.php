<?php
class AuthController {
    private $db;
    private $auth;

    public function __construct() {
        $this->db = new PDO("mysql:host=localhost;dbname=duan1", "root", "");
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->auth = new Auth();
    }

    public function showLoginForm() {
        if (isset($_SESSION['admin_id']) && $this->auth->isAdmin()) {
            header('Location: index.php');
            exit;
        }
        require_once './views/login.php';
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
                    
                    header('Location: index.php');
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

    public function logout() {
        $this->auth->logout();
    }
}