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

    public function getAllSanPhamHot()
    {
        try {
            $sql = "SELECT 
                c.id, 
                c.title, 
                c.image, 
                c.original_price,
                cs.sale_value,
                COALESCE(AVG(r.rating), 0) AS average_rating,
                COUNT(DISTINCT r.id) AS review_count,
                COUNT(DISTINCT o.id) AS purchase_count
            FROM comics c
            LEFT JOIN comic_sales cs ON c.id = cs.comic_id
                AND cs.end_date >= CURRENT_DATE 
                AND cs.start_date <= CURRENT_DATE
            LEFT JOIN reviews r ON c.id = r.comic_id AND r.status = 'approved' 
            LEFT JOIN order_items od ON c.id = od.comic_id
            LEFT JOIN orders o ON od.order_id = o.id AND o.shipping_status = 'delivered' 
            GROUP BY c.id, c.title, c.image, c.original_price, cs.sale_value
            HAVING review_count > 0 AND purchase_count > 0 
            ORDER BY review_count DESC, purchase_count DESC";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            error_log("Error in getAllSanPhamHot: " . $e->getMessage());
            return [];
        }
    }

    public function getAllSanPham()
    {
        try {
            $sql = "SELECT 
                c.*, 
                cs.sale_value
            FROM comics c
            LEFT JOIN comic_sales cs ON c.id = cs.comic_id 
                AND cs.end_date >= CURRENT_DATE 
                AND cs.start_date <= CURRENT_DATE
            ORDER BY c.id ASC";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            error_log("Error fetching all products: " . $e->getMessage());
            return [];
        }
    }

    public function getSanPhamCungLoai($category_id)
    {
        try {
            $sql = "SELECT 
                c.*, 
                cs.sale_value
            FROM comics c
            LEFT JOIN comic_sales cs ON c.id = cs.comic_id 
                AND cs.end_date >= CURRENT_DATE 
                AND cs.start_date <= CURRENT_DATE
            WHERE c.category_id = :category_id
            ORDER BY c.id ASC";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([":category_id" => $category_id]);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            error_log("Error in getSanPhamCungLoai: " . $e->getMessage());
            return [];
        }
    }

    public function getAllSanPhamSale()
    {
        try {
            $sql = "SELECT 
                c.*, 
                cs.sale_value
            FROM comics c
            INNER JOIN comic_sales cs ON c.id = cs.comic_id 
                AND cs.end_date >= CURRENT_DATE 
                AND cs.start_date <= CURRENT_DATE
            WHERE cs.sale_value > 0
            ORDER BY c.original_price DESC";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            error_log("Error in getAllSanPhamSale: " . $e->getMessage());
            return [];
        }
    }

    public function getSanPhamById($id)
    {
        try {
            $sql = "SELECT 
                c.*, 
                cs.sale_value,
                v.format,
                v.language
            FROM comics c
            LEFT JOIN comic_sales cs ON c.id = cs.comic_id 
                AND cs.end_date >= CURRENT_DATE 
                AND cs.start_date <= CURRENT_DATE
            LEFT JOIN comic_variants v ON c.id = v.comic_id
            WHERE c.id = :id";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetch();
        } catch (Exception $e) {
            error_log("Error in getSanPhamById: " . $e->getMessage());
            return [];
        }
    }

    public function getSanPhamAllVariant($id)
    {
        try {
            $sql = "SELECT 
                v.*,
                cs.sale_value,
                CASE 
                    WHEN cs.end_date >= CURRENT_DATE AND cs.start_date <= CURRENT_DATE THEN 1
                    ELSE 0
                END as is_on_sale
            FROM comic_variants v
            LEFT JOIN comic_sales cs ON v.comic_id = cs.comic_id
            WHERE v.comic_id = :id";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            error_log("Error in getSanPhamAllVariant: " . $e->getMessage());
            return [];
        }
    }

    public function searchProducts($keyword = '', $category_id = '', $price_min = 0, $price_max = PHP_INT_MAX, $sort = '')
    {
        try {
            $sql = "SELECT c.*, cs.sale_value,
                    CASE 
                        WHEN cs.sale_value IS NOT NULL 
                        THEN c.original_price * (1 - cs.sale_value/100)
                        ELSE c.original_price 
                    END as final_price
                    FROM comics c
                    LEFT JOIN comic_sales cs ON c.id = cs.comic_id 
                        AND cs.end_date >= CURRENT_DATE 
                        AND cs.start_date <= CURRENT_DATE
                    WHERE 1=1";
            
            $params = [];

            // Tìm kiếm theo từ khóa
            if (!empty($keyword)) {
                $sql .= " AND (c.title LIKE :keyword OR c.description LIKE :keyword)";
                $params[':keyword'] = "%$keyword%";
            }

            // Lọc theo danh mục
            if (!empty($category_id)) {
                $sql .= " AND c.category_id = :category_id";
                $params[':category_id'] = $category_id;
            }

            // Lọc theo giá
            if ($price_min > 0) {
                $sql .= " AND c.original_price >= :price_min";
                $params[':price_min'] = $price_min;
            }
            if ($price_max < PHP_INT_MAX) {
                $sql .= " AND c.original_price <= :price_max";
                $params[':price_max'] = $price_max;
            }

            // Sắp xếp
            switch ($sort) {
                case 'price_asc':
                    $sql .= " ORDER BY final_price ASC";
                    break;
                case 'price_desc':
                    $sql .= " ORDER BY final_price DESC";
                    break;
                case 'name_asc':
                    $sql .= " ORDER BY c.title ASC";
                    break;
                case 'name_desc':
                    $sql .= " ORDER BY c.title DESC";
                    break;
                default:
                    $sql .= " ORDER BY c.id DESC";
            }

            $stmt = $this->conn->prepare($sql);
            foreach ($params as $key => $value) {
                $stmt->bindValue($key, $value);
            }
            $stmt->execute();
            
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log("Lỗi truy vấn searchProducts: " . $e->getMessage());
            return [];
        }
    }
}
?>