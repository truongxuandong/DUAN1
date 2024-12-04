<?php

class User
{
    private $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }


    public function getAll()
    {
        try {

            $sql = "SELECT * FROM users WHERE role = 'user' ORDER BY id ASC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
    public function addUser($name, $email, $password, $phone, $avatar)
{
    try {
        $email = trim(strtolower($email));
        // Kiểm tra email đã tồn tại chưa
        $stmtCheck = $this->conn->prepare("SELECT id FROM users WHERE email = :email");
        $stmtCheck->execute(['email' => $email]);
        if ($stmtCheck->fetch(PDO::FETCH_ASSOC)) {
            $_SESSION['error'] = "Email đã tồn tại. Vui lòng sử dụng email khác.";
            return false;
        }

        // Kiểm tra đầu vào
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = "Email không hợp lệ.";
            return false;
        }
        if (!is_numeric($phone) || strlen($phone) < 10) {
            $_SESSION['error'] = "Số điện thoại không hợp lệ.";
            return false;
        }
        if (strlen($password) < 6) {
            $_SESSION['error'] = "Mật khẩu phải có ít nhất 6 ký tự.";
            return false;
        }

        // Mã hóa mật khẩu
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Thêm người dùng
        $sql = "INSERT INTO users (name, email, password, phone, avatar) 
                VALUES (:name, :email, :password, :phone, :avatar)";
        $stmt = $this->conn->prepare($sql);

        if (!$stmt->execute([
            'name' => $name,
            'email' => $email,
            'password' => $hashedPassword,
            'phone' => $phone,
            'avatar' => $avatar,
        ])) {
            $_SESSION['error'] = "Không thể thêm người dùng. Vui lòng thử lại.";
            return false;
        }

        return true;
    } catch (PDOException $e) {
        // Ghi log lỗi
        error_log("Lỗi SQL: " . $e->getMessage());
        // Gửi lỗi chi tiết để debug
        $_SESSION['error'] = "Lỗi SQL: " . $e->getMessage();
        return false;
    }
    
}


    public function getTaiKhoan($id)
    {
        try {
            $sql = 'SELECT* FROM users WHERE id=:id';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([':id' => $id]);
            return $stmt->fetch();
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }


    public function updateuser($id, $name, $email, $phone, $avatar)
{
    try {
        // Chuẩn hóa email (chuyển thành chữ thường)
        $email = trim(strtolower($email));

        // Kiểm tra email đã tồn tại và không phải email của người dùng hiện tại
        $stmtCheck = $this->conn->prepare("SELECT id FROM users WHERE email = :email AND id != :id");
        $stmtCheck->execute(['email' => $email, 'id' => $id]);

        if ($stmtCheck->fetch(PDO::FETCH_ASSOC)) {
            $_SESSION['error'] = "Email đã tồn tại. Vui lòng sử dụng email khác.";
            return false;
        }

        // Kiểm tra định dạng email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = "Email không hợp lệ.";
            return false;
        }

        // Kiểm tra số điện thoại
        if (!is_numeric($phone) || strlen($phone) < 10) {
            $_SESSION['error'] = "Số điện thoại không hợp lệ.";
            return false;
        }

        // Cập nhật thông tin người dùng
        $sql = "UPDATE users 
                SET name = :name, email = :email, phone = :phone, avatar = :avatar
                WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':id' => $id,
            ':name' => $name,
            ':email' => $email,
            ':phone' => $phone,
            ':avatar' => $avatar
        ]);

        return true;

    } catch (PDOException $e) {
        // Ghi log lỗi SQL
        error_log("Lỗi khi cập nhật tài khoản: " . $e->getMessage());
        $_SESSION['error'] = "Có lỗi xảy ra khi cập nhật tài khoản. Vui lòng thử lại!";
        return false;
    } catch (Exception $e) {
        // Lỗi khác (do logic)
        error_log("Lỗi khác: " . $e->getMessage());
        $_SESSION['error'] = "Có lỗi xảy ra khi cập nhật tài khoản. Vui lòng thử lại!";
        return false;
    }
}




    public function deleteuser($id)
    {
        try {
            $sql = 'DELETE FROM users WHERE id=:id';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([':id' => $id]);
            return true;
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }

    public function isEmailExists($email, $excludeId = null)
    {
        try {
            $sql = 'SELECT * FROM users WHERE email = :email' . ($excludeId ? ' AND id != :id' : '');
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':email' => $email, ':id' => $excludeId]);
            return $stmt->rowCount() > 0; // Trả về true nếu email đã tồn tại
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
}
