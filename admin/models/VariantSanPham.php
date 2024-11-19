<?php

class Variant {
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();  // Ensure this function connects to your database
    }

    
    public function getVariantsByComicId($comicId) {
        try {
            $sql = "SELECT comic_variants.*,
            (SELECT sale_value 
             FROM comic_sales 
             WHERE comic_sales.comic_id = comic_variants.comic_id 
             LIMIT 1) AS sale
            FROM comic_variants
            WHERE comic_variants.comic_id = :comic_id";
    

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':comic_id' => $comicId]);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo "Error fetching variants: " . $e->getMessage();
            return false;
        }
    }
    

    // Insert a new variant for a specific comic
    public function insertVariant($comic_id, $format, $language, $isbn, $original_price, $price, $stock_quantity, $publication_date, $image) {
        try {
            $sql = "INSERT INTO comic_variants (comic_id, format, language, isbn, original_price, price, stock_quantity, publication_date, image)
                    VALUES (:comic_id, :format, :language, :isbn, :original_price, :price, :stock_quantity, :publication_date, :image)";
            
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([
                ':comic_id' => $comic_id,
                ':format' => $format,
                ':language' => $language,
                ':isbn' => $isbn,
                ':original_price' => $original_price,
                ':price' => $price,
                ':stock_quantity' => $stock_quantity,
                ':publication_date' => $publication_date,
                ':image' => $image
            ]);
        } catch (PDOException $e) {
            error_log("Error inserting variant: " . $e->getMessage());
            return false;
        }
    }

    // Get variant by ID
    public function getVariantById($id) {
        try {
            $sql = "SELECT * FROM comic_variants WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error fetching variant: " . $e->getMessage());
            return false;
        }
    }

    // Update an existing variant
    public function updateVariant($id, $comic_id, $format, $language, $isbn, $original_price, $price, $stock_quantity, $publication_date, $image) {
        try {
            $sql = "UPDATE comic_variants SET 
                        comic_id = :comic_id, 
                        format = :format, 
                        language = :language,
                        isbn = :isbn,
                        original_price = :original_price,
                        price = :price,
                        stock_quantity = :stock_quantity,
                        publication_date = :publication_date,
                        image = :image
                    WHERE id = :id";
            
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([
                ':id' => $id,
                ':comic_id' => $comic_id,
                ':format' => $format,
                ':language' => $language,
                ':isbn' => $isbn,
                ':original_price' => $original_price,
                ':price' => $price,
                ':stock_quantity' => $stock_quantity,
                ':publication_date' => $publication_date,
                ':image' => $image
            ]);
        } catch (PDOException $e) {
            error_log("Error updating variant: " . $e->getMessage());
            return false;
        }
    }

    // Delete a product variant by ID
    public function deleteVariant($id) {
        try {
            // First, get the variant details to access the image path
            $variant = $this->getVariantById($id);
            if (!$variant) {
                return false; // Variant not found
            }

            $imagePath = $variant['image'];
            $comicId = $variant['comic_id'];

            // Delete the variant from the database
            $sql = "DELETE FROM comic_variants WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                // If a file exists, delete it from the server
                if (!empty($imagePath) && file_exists($imagePath)) {
                    unlink($imagePath); // Delete the image file
                }

                return true;
            } else {
                echo "Error deleting variant!";
                return false;
            }
        } catch (PDOException $e) {
            echo "Error deleting variant: " . $e->getMessage();
            return false;
        }
    }

    
    public function getIdVariants() {
        try {
            $sql = "SELECT v.*, c.title as comic_title FROM comic_variants v
                    LEFT JOIN comics c ON v.comic_id = c.id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error fetching all variants: " . $e->getMessage();
            return false;
        }
    }
}

?>
