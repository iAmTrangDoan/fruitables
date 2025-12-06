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
                $categories=$this->categoryModel->getCategories();
                $data['categories']=$categories;

                $data['all_products']=$this->productModel->getProducts();

                $data['grouped_products'] = [];

                foreach($categories as $category){
                    $categoryId=$category['id'];
                    $products_of_category=$this->productModel->getProductsByCategory($categoryId);
                    $data['grouped_products'][$categoryId] = $products_of_category;
                }
               
                foreach($data['categories'] as &$category)
                    $category['product_count'] = $this->categoryModel->countProducts($category['id']);
                
            }catch(PDOException $e){
                $data['error']=$e->getMessage();
            }
            return $data;
        }
    }
        
?>