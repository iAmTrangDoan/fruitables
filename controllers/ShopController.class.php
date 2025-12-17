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

        public function loadData($page=1,$categoryId = null){
            $data=[];
            $limit=6;
            // Lấy trang hiện tại từ URL (nếu có, ví dụ: index.php?page=2)
            $currentPage = max(1, (int)($page)); // Đảm bảo trang >= 1
            // Đọc tham số lọc từ URL nếu chưa được truyền
            if ($categoryId === null && isset($_GET['category_id']) && is_numeric($_GET['category_id'])) {
                $categoryId = (int)$_GET['category_id'];
            }
            try{

               $data['categories'] = $this->categoryModel->getCategories();
            
                //Tính tổng sản phẩm theo filter (nếu có) + số trang
                $totalProducts = $this->productModel->countAllProducts($categoryId);
                $data['total_pages'] = ceil($totalProducts / $limit);
                $data['current_page'] = $currentPage;
                $data['current_category_id'] = $categoryId; // Lưu lại ID đang lọc

                //Lấy sản phẩm có phân trang theo filter (nếu có)
                $data['all_products'] = $this->productModel->getProducts($limit, $currentPage,$categoryId);

                // 4. Lấy sản phẩm nhóm theo danh mục 
                $data['grouped_products'] = [];
                
                //Truyền tham biến đếm sản phẩm theo danh mục vào mảng $data
                foreach($data['categories'] as &$category) {
                    //Lấy sản phẩm theo danh mục với id của category lấy từ mảng categories
                    $data['grouped_products'][$category['id']] =$this->productModel->getProductsByCategory($category['id']);
                    // Cập nhật Product Count
                    $category['product_count'] = $this->productModel->countAllProducts($category['id']) ?? 0;
                }
                unset($category); // Hủy tham chiếu
            }catch(PDOException $e){
                $data['error']=$e->getMessage();
            }
            return $data;
        }
    }
        
?>