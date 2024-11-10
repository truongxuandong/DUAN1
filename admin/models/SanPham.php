<?php

class SanPham {
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getAllSanPham(){
        try{
            $sql = 'SELECT san_phams.*, danh_mucs.ten_danh_muc
            FROM san_phams
            INNER JOIN danh_mucs ON san-phams.danh_muc_id = danh_mucs.id

            ';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll();
        }catch (Exception $e){

        }
    }
    public function insertSanPham($title, $author_id, $category_id, $description, $publication_date, $price, $stock_quantity, $image, $hinh_anh){
        try{
            $sql = 'INSERT INTO san_phams (title,author_id,category_id,description,publication_date,price,stock_quantity,image,hinh_anh)
                    VALUES (:title,:author_id,:category_id,:description,:publication_date,:price,:stock_quantity,:image,:hinh_anh)';

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':title' => $title,
                'author_id' => $author_id,
                'category_id' => $category_id,
                'description' => $description,
                'publication_date' => $publication_date,
                'price' => $price,
                'stock_quantity' => $stock_quantity,
                'image' => $image,
                'hinh_anh' => $hinh_anh
            ]);
            return true;
        }catch(Exception $e){
            echo "lỗi" . $e->getMessage();
        }
    }
}