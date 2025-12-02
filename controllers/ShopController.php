<?php
    if (!defined('ACCESS_ALLOWED')) {
    die('Direct access not allowed');
    }

    class ShopController{
        private $pdo;
        private $categoryModel;
        private $productModel;

        public function __construct($pdo)
        {
            $this->pdo=$pdo;
            $this->categoryModel= new CategoryModel($pdo);
            $this->productModel= new ProductModel($pdo);

        }

        public function loadData(){
            $data=[];
            try{
                $data['categories']=$this->categoryModel->getCategories();
                $data['products']=$this->productModel->getProducts();

                foreach($data['categories'] as &$category)
                    $category['product_count'] = $this->categoryModel->countProducts($category['id']);
            }catch(PDOException $e){
                $data['error']=$e->getMessage();
            }
            return $data;
        }
    }
?>