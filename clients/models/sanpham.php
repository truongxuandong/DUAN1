<?php
class SanPham
{
    private $conn;

    public function __construct()
    {
        $this->conn = $this->connectDB();
    }

    private function connectDB()
    {
        try {
            return new PDO("mysql:host=localhost;dbname=duan1", "root", "", [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
        } catch (PDOException $e) {
            die("Database connection error: " . $e->getMessage());
        }
    }

    public function getAllSanPham()
    {
        try {
            $sql = "
                SELECT comics.*, comic_sales.sale_value
                FROM comics
                LEFT JOIN comic_sales ON comics.id = comic_sales.comic_id
                ORDER BY comics.id ASC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            error_log("Error fetching all products: " . $e->getMessage());
            return [];
        }
    }

    public function getSanPhamById($id)
    {
        try {
            $sql = "SELECT * FROM comics WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch();
        } catch (Exception $e) {
            error_log("Error fetching product by ID: " . $e->getMessage());
            return null;
        }
    }

    public function timKiem($query)
    {
        try {
            $sql = "SELECT * FROM comics WHERE title LIKE :query OR description LIKE :query";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':query', '%' . $query . '%', PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            error_log("Error searching products: " . $e->getMessage());
            return [];
        }
    }

    public function layChiTietSanPham($id)
    {
        try {
            $sql = "SELECT * FROM comics WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch();
        } catch (Exception $e) {
            error_log("Error fetching product details: " . $e->getMessage());
            return null;
        }
    }

    public function timKiemVaLoc($query, $category_id = null, $min_price = null, $max_price = null, $min_rating = null, $page = 1, $limit = 10)
    {
        try {
            $offset = ($page - 1) * $limit;
            $sql = "SELECT * FROM comics WHERE (title LIKE :query OR description LIKE :query)";

            // Add dynamic filters
            if (!empty($category_id) && $category_id !== 'all') {
                $sql .= " AND category_id = :category_id";
            }
            if (!empty($min_price)) {
                $sql .= " AND price >= :min_price";
            }
            if (!empty($max_price)) {
                $sql .= " AND price <= :max_price";
            }
            if (!empty($min_rating)) {
                $sql .= " AND rating >= :min_rating"; // Assuming `rating` is a column in the comics table
            }

            // Add pagination limit and offset
            $sql .= " LIMIT :offset, :limit";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':query', '%' . $query . '%', PDO::PARAM_STR);

            // Bind dynamic filters
            if (!empty($category_id) && $category_id !== 'all') {
                $stmt->bindValue(':category_id', (int)$category_id, PDO::PARAM_INT);
            }
            if (!empty($min_price)) {
                $stmt->bindValue(':min_price', (int)$min_price, PDO::PARAM_INT);
            }
            if (!empty($max_price)) {
                $stmt->bindValue(':max_price', (int)$max_price, PDO::PARAM_INT);
            }
            if (!empty($min_rating)) {
                $stmt->bindValue(':min_rating', (int)$min_rating, PDO::PARAM_INT);
            }

            // Bind limit and offset
            $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
            $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);

            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            error_log("Error filtering and searching products: " . $e->getMessage());
            return [];
        }
    }

}
?>
