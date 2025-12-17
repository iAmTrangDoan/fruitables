<?php
if (!defined('ACCESS_ALLOWED')) {
    die('Direct access not allowed');
}


class ProductController
{
    private $model;

    public function __construct($pdo)
    {
        $this->model = new ProductModel($pdo);
    }

    public function index()
    {
        try {
            $data = $this->model->getProductsForAdmin();
            $error = null;
        } catch (Exception $e) {
            $data = [];
            $error = $e->getMessage();
        }
        require '../admin/product-list.php';
    }


    public function form()
    {
        $id = $_GET['id'] ?? null;
        $product = null;

        if ($id) {
            $product = $this->model->getById($id);
            if (!$product) {
                die('Product not found');
            }
        }

        require '../admin/product-add.php';
    }

    public function save()
    {

        $data = [
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'price' => $_POST['price'],
            'stock_quantity' => $_POST['stock_quantity'],
            'image_url' => $_POST['image_url'],
            'category_id' => $_POST['category_id']
        ];

        if (!empty($_POST['id'])) {
            $this->model->update($_POST['id'], $data);
        } else {
            $this->model->insert($data);
        }

        header('Location: product-list.php');
        exit;
    }

    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            die('Invalid request');
        }

        if (empty($_POST['id'])) {
            die('Missing category ID');
        }

        $id = (int)$_POST['id'];

        $this->model->delete($id);

        header('Location: product-list.php');
        exit;
    }
}
