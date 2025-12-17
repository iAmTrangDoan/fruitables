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

         public function getById($id)
        {
            $sql = "SELECT * FROM categories WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function insert($name, $description)
        {
            $sql = "INSERT INTO categories(name, description) VALUES (?, ?)";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$name, $description]);
        }

        public function update($id, $name, $description)
        {
            $sql = "UPDATE categories SET name = ?, description = ? WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$name, $description, $id]);
        }

        public function delete($id)
        {
            $sql = "DELETE FROM categories WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$id]);
        }


    }
?>