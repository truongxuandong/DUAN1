<?php
class AdminGiaodien
{
    public $conn;

    public function __construct() {
        $this->conn = connectDB(); // Kết nối đến cơ sở dữ liệu
    }

    // Lấy tất cả banner
    public function getAllBanners() {
        try {
            $sql = "SELECT * FROM banners";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }
    public function addBanner($Title, $Description, $Img, $Status, $Position)
{
        $sql = "INSERT INTO banners (Title,  Description,Img, Status, Position)
                VALUES (:Title,  :Description,:Img, :Status, :Position)";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            ':Title' => $Title,
            ':Description' => $Description,
            ':Img' => $Img,
            ':Status' => $Status,
            ':Position' => $Position 
            
        ]);        
}

    
        
    
    // 
    public function insertBanner($Title, $Description, $Img, $Status, $Position)
    {
        try {
            // Kiểm tra giá trị truyền vào
            if (empty($Title) || empty($Description) || empty($Img) || empty($Status)) {
                throw new Exception("Các trường Title, Description, Img và Status không được để trống.");
            }
    
            // Thực hiện câu lệnh SQL
            $sql = 'INSERT INTO banners (Title, Description, Img, Status, Position) 
                    VALUES (:Title, :Description, :Img, :Status, :Position)';
            $stmt = $this->conn->prepare($sql);
    
            $stmt->execute([
                ':Title' => $Title,
                ':Description' => $Description,
                ':Img' => $Img,
                ':Status' => $Status,
                ':Position' => $Position,
            ]);
    
            // Lấy ID của banner vừa được thêm
            $lastInsertId = $this->conn->lastInsertId();
            return $lastInsertId; // Trả về ID của banner vừa thêm
        } catch (Exception $e) {
            // Xử lý lỗi và ghi log nếu cần
            error_log("Lỗi khi thêm banner: " . $e->getMessage());
            return false;
        }
    }
    
    public function toggleBannerStatus($ID, $Status) {
        try {
            // Điều kiện để xác định trạng thái hiển thị hoặc ẩn
            // $newStatus = ($Status == 1) ? 1 : 0; // Nếu Status là 1 thì hiển thị, còn không là ẩn

            // Cập nhật trạng thái
            $sql = "UPDATE banners SET Status = :Status WHERE ID = :ID";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':Status' => $Status,
                ':ID' => $ID
            ]);
            
            // Trả về kết quả
            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }
    public function deleteBanner($ID)
{
    try {
        // Chuẩn bị câu lệnh SQL để xóa banner theo ID
        $sql = 'DELETE FROM banners 
        WHERE ID = :ID';
        $stmt = $this->conn->prepare($sql);
        
        $stmt->execute([':ID' => $ID]);
        return true;
    } catch (Exception $e) {
        echo "Lỗi: " . $e->getMessage();
        return false;
    }
}
public function getDetailBanner($ID){
    try {
        $sql = "SELECT  *
        from banners
        where ID = :ID";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':ID' => $ID]);
        return $stmt->fetch();
    }catch (Exception $e){
        echo "lỗi" .$e->getMessage();
    }
 }
 public function updateBanner($ID,$Title,$Description,$Img,$Status,$Position,$Create_at,$Update_at){
    try {
        $sql = 'UPDATE banners
            SET
            Title = :Title,
            Description = :Description,
            Img = :Img,
            Status = :Status,
            Position = :Position,
            Create_at = :Create_at,
            Update_at = :Update_at
            
            where ID = :ID';
        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            ':ID' => $ID,
            ':Title' => $Title,
            ':Description' => $Description,
            ':Img' => $Img,
            ':Status' => $Status,
            ':Position' => $Position,
            ':Create_at' => $Create_at,
            ':Update_at' => $Update_at
            
        ]);
        //lấy id sản phẩm vừa thêm
        return true;
    }catch (Exception $e){
        echo "lỗi" .$e->getMessage();
    }
}
public function updateBanners($ID, $Title, $Description, $Img, $Status, $Position)
{
    try {
        // Câu lệnh SQL để cập nhật banner
        $sql = 'UPDATE banners
                SET
                    Title = :Title,
                    Description = :Description,
                    Img = :Img,
                    Status = :Status,
                    Position = :Position
                WHERE ID = :ID';

        // Chuẩn bị câu lệnh
        $stmt = $this->conn->prepare($sql);

        // Thực thi câu lệnh với tham số
        $stmt->execute([
            ':ID' => $ID,
            ':Title' => $Title,
            ':Description' => $Description,
            ':Img' => $Img,
            ':Status' => $Status,
            ':Position' => $Position
        ]);

        return true; // Trả về true nếu cập nhật thành công
    } catch (Exception $e) {
        // Ghi log hoặc hiển thị lỗi nếu cần
        error_log("Lỗi khi cập nhật banner: " . $e->getMessage());
        return false; // Trả về false nếu có lỗi
    }
}

}
   
    