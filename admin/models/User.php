
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
        try {
            $sql = 'SELECT* FROM users WHERE id=:id';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([':id'=>$id]);
            return $stmt->fetch();
        }catch (Exception $e){
            echo "lỗi" .$e->getMessage();
        }
    }


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
        try {
            $sql = 'DELETE FROM users WHERE id=:id';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([':id'=>$id]);
            return true;
        }catch (Exception $e){
            echo "lỗi" .$e->getMessage();
        }
    }
} 

?>