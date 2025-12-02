<?php

    if (!defined('ACCESS_ALLOWED')) {
    die('Direct access not allowed');
    }

    class CategoryModel{
        private $pdo;

        public function __construct($pdo)
        {
            $this->pdo=$pdo;
        }

        public function getCategories(){
            try{
                $sql="SELECT * FROM categories";
                $stmt=$this->pdo->prepare($sql);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }catch(PDOException $e)
            {
                throw new Exception("Lỗi lấy danh sách danh mục".$e->getMessage());
            }
        }

        public function countProducts($categoryId){
            try{
                $sql="SELECT COUNT(*) FROM products WHERE category_id=? ";
                $stmt=$this->pdo->prepare($sql);
                $stmt->bindParam(1,$categoryId,PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetchColumn();
            }catch(PDOException $e){
                return 0;
            }
        }

    }
?>