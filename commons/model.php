<?php 

// class BaseModel {
//     public $conn;

//     public function __construct() {
//         global $coreApp;
//         $this->conn = $coreApp->connectDB();
//     }

//     protected function allTable($table) {
//         try {
//             $sql = "SELECT * FROM {$table} ORDER BY id DESC";
//             $stmt = $this->conn->prepare($sql);
//             $stmt->execute();
//             return $stmt->fetchAll();
//         } catch (Exception $e) {
//             debug($e);
//         }
//     }

//     protected function findIdTable($id, $table) {
//         try {
//             $sql = "SELECT * FROM {$table} WHERE id = :id";
    
//             $stmt = $this->conn->prepare($sql);
        
//             $stmt->execute([':id' => $id]);

//             return $stmt->fetch();
//         } catch(Exception $e) {
//             debug($e);
//         }
//     }

    // protected function removeIdTable($id, $table) {
    //     try {
    //         $sql = "DELETE FROM {$table} WHERE (`id` = :id)";
    
    //         $stmt = $this->conn->prepare($sql);
        
    //         return $stmt->execute([
    //             ':id' => $id
    //         ]);
    //     } catch(Exception $e) {
    //         debug($e);
    //     }
    // }

    // protected function insertTable($table, $data) {
    //     try {
            // Lấy các tên cột từ mảng $data
//             $columns = array_keys($data);
//             // Tạo chuỗi các tên cột
//             $columnsString = implode(', ', $columns);
//             // Tạo chuỗi các placeholder
//             $placeholders = ':' . implode(', :', $columns);
            
//             // Tạo câu lệnh SQL
//             $sql = "INSERT INTO $table ($columnsString) VALUES ($placeholders)";
            
//             $stmt = $this->conn->prepare($sql);
            
//             // Chuyển đổi mảng $data thành mảng có dạng ['column' => value]
//             $parameters = [];
//             foreach ($data as $key => $value) {
//                 $parameters[":$key"] = $value;
//             }

//             return $stmt->execute($parameters);
//         } catch(Exception $e) {
//             debug($e);
//         }
//     }

//     protected function updateIdTable($table, $data, $id) {
//         try {
//             // Lấy các tên cột từ mảng $data
//             $columns = array_keys($data);
//             // Tạo chuỗi các cặp 'column = :column'
//             $setString = implode(', ', array_map(function($col) {
//                 return "$col = :$col";
//             }, $columns));
            
//             // Tạo câu lệnh SQL
//             $sql = "UPDATE $table SET $setString WHERE id = :id";
            
//             $stmt = $this->conn->prepare($sql);
            
//             // Chuyển đổi mảng $data thành mảng có dạng ['column' => value]
//             $parameters = [];
//             foreach ($data as $key => $value) {
//                 $parameters[":$key"] = $value;
//             }
//             // Thêm id vào mảng parameters
//             $parameters[':id'] = $id;

//             return $stmt->execute($parameters);
//         } catch(Exception $e) {
//             debug($e);
//         }
//     }
// }