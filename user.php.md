
<<<<<<< HEAD
<?php
ob_start();
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
    public function adduser($name, $email, $password, $phone, $avatar)
    {
        try {
            $sql = "INSERT INTO users(name,email,password,phone,avatar) 
        Values(:name,:email,:password,:phone,:avatar)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':name' => $name,
                ':email' => $email,
                ':password' => $password,
                ':phone' => $phone,
                ':avatar' => $avatar,

            ]);
            return true;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function getTaiKhoan($id)
    {
=======
<?php 

class User 
{
    private $conn;

    public function __construct() {
        $this->conn=connectDB();
    }

    public function getAll() {
    try{

        $sql = "SELECT * FROM users WHERE role = 'user' ORDER BY id ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    }
     public function adduser($name,$email,$password,$phone,$avatar) {
        try{
        $sql = "INSERT INTO users(name,email,password,phone,avatar) 
        Values(:name,:email,:password,:phone,:avatar)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':name'=>$name,
            ':email'=>$email,
            ':password'=>$password,
            ':phone'=>$phone,
            ':avatar'=>$avatar,
           
        ]);
        return true;
    }catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    }

    public function getTaiKhoan($id){
>>>>>>> 3e736630e64aac4e3dce81c127a71dcf4ea40427
        try {
            $sql = 'SELECT* FROM users WHERE id=:id';

            $stmt = $this->conn->prepare($sql);

<<<<<<< HEAD
            $stmt->execute([':id' => $id]);
            return $stmt->fetch();
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
=======
            $stmt->execute([':id'=>$id]);
            return $stmt->fetch();
        }catch (Exception $e){
            echo "lỗi" .$e->getMessage();
>>>>>>> 3e736630e64aac4e3dce81c127a71dcf4ea40427
        }
    }


<<<<<<< HEAD
    public function updateuser($id, $name, $email, $phone, $avatar)
    {
        try {
            $sql =  "UPDATE users SET name = :name, email = :email, phone = :phone, avatar = :avatar WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':id' => $id,
                ':name' => $name,
                ':email' => $email,
                ':phone' => $phone,
                ':avatar' => $avatar,

            ]);
            return true;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }


    public function deleteuser($id)
    {
=======
    public function updateuser($id,$name,$email,$phone,$avatar) {
        try{
        $sql =  "UPDATE users SET name = :name, email = :email, phone = :phone, avatar = :avatar WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':id'=>$id,
            ':name'=>$name,
            ':email'=>$email,
            ':phone'=>$phone,
            ':avatar'=>$avatar,
           
        ]);
        return true;
    }catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    }


    public function deleteuser($id){
>>>>>>> 3e736630e64aac4e3dce81c127a71dcf4ea40427
        try {
            $sql = 'DELETE FROM users WHERE id=:id';

            $stmt = $this->conn->prepare($sql);

<<<<<<< HEAD
            $stmt->execute([':id' => $id]);
            return true;
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }
    public function checklogin($email, $password)
    {
        // Assuming you have a database connection ($this->conn)
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':email' => $email]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch user data as an associative array

        if ($user) {
            return $user; // Return the user data array
        }
        return null; // Return null if no user is found
    }



    public function registerUser($name, $email, $password, $phone, $avatar)
    {
        try {
            // No password hashing, store plain text password
            $sql = "INSERT INTO users (name, email, password, phone, avatar) 
                VALUES (:name, :email, :password, :phone, :avatar)";
            $stmt = $this->conn->prepare($sql);

            return $stmt->execute([
                ':name' => $name,
                ':email' => $email,
                ':password' => $password, // Store plain text password
                ':phone' => $phone,
                ':avatar' => $avatar
            ]);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
ob_end_flush();
=======
            $stmt->execute([':id'=>$id]);
            return true;
        }catch (Exception $e){
            echo "lỗi" .$e->getMessage();
        }
    }
} 

>>>>>>> 3e736630e64aac4e3dce81c127a71dcf4ea40427
?>