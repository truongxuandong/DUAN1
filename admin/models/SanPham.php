<?php

class SanPham {
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }
    
    public function getAllSanPham(){
        try {
            $sql = "SELECT comics.id, comics.title, comics.author_id, comics.category_id, comics.description, 
                           comics.publication_date, comics.price, comics.original_price, comics.stock_quantity, comics.image, 
                           authors.name AS author_name, categories.name AS category_name
                    FROM comics
                    JOIN authors ON comics.author_id = authors.id
                    JOIN categories ON comics.category_id = categories.id";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function getAllTacGia(){
        try {
            $sql = 'SELECT * FROM authors';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function insertSanPham($title, $author_id, $category_id, $description, $publication_date, $price, $original_price, $stock_quantity, $image) {
        try {
            $sql = "INSERT INTO comics (title, author_id, category_id, description, publication_date, price, original_price, stock_quantity, image)
                    VALUES (:title, :author_id, :category_id, :description, :publication_date, :price, :original_price, :stock_quantity, :image)";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':author_id', $author_id);
            $stmt->bindParam(':category_id', $category_id);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':publication_date', $publication_date);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':original_price', $original_price);
            $stmt->bindParam(':stock_quantity', $stock_quantity);
            $stmt->bindParam(':image', $image);
            
            if ($stmt->execute()) {
                echo "Sản phẩm đã được thêm thành công!";
                return true;
            } else {
                echo "Lỗi khi thêm sản phẩm!";
                return false;
            }
        } catch (PDOException $e) {
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }

    public function getSanPhamById($id) {
        try {
            $sql = "SELECT * FROM comics WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error getting product by ID: " . $e->getMessage());
            return false;
        }
    }

    public function updateSanPham($id, $title, $author_id, $category_id, $description, $publication_date, $price, $original_price, $stock_quantity, $image) {
        try {
            $sql = "UPDATE comics SET 
                        title = :title, 
                        author_id = :author_id, 
                        category_id = :category_id, 
                        description = :description, 
                        publication_date = :publication_date, 
                        price = :price,
                        original_price = :original_price,
                        stock_quantity = :stock_quantity, 
                        image = :image 
                    WHERE id = :id";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':author_id', $author_id);
            $stmt->bindParam(':category_id', $category_id);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':publication_date', $publication_date);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':original_price', $original_price);
            $stmt->bindParam(':stock_quantity', $stock_quantity);
            $stmt->bindParam(':image', $image);
            $stmt->bindParam(':id', $id);
    
            if ($stmt->execute()) {
                return true;
            } else {
                echo "Lỗi khi thực thi truy vấn SQL.";
                return false;
            }
        } catch (PDOException $e) {
            echo "Lỗi truy vấn: " . $e->getMessage();
            return false;
        }
    }

    public function deleteSanPham($id) {
        try {
            $sql = "DELETE FROM comics WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }
}

?>
