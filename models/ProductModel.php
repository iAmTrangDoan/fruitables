<?php
    
    if (!defined('ACCESS_ALLOWED')) {
    die('Direct access not allowed');
    }

    class ProductModel{
        private $pdo;

        public function __construct($pdo)
        {
            $this->pdo=$pdo;
        }

        public function getProducts($limit =9){
            try{
                $sql="SELECT * FROM products ORDER BY id LIMIT ?";
                $stmt=$this->pdo->prepare($sql);
                $stmt->bindParam(1,$limit,PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);

            }catch(PDOException $e){
                throw new Exception("Lỗi lấy danh sách sản phẩm ".$e->getMessage());
            }
            
        }
    }
?>