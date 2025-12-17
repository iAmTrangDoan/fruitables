<?php
if (!defined('ACCESS_ALLOWED')) {
    die('Direct access not allowed');
}


class CategoryController
{
    private $model;

    public function __construct($pdo)
    {
        $this->model = new CategoryModel($pdo);
    }

    public function index()
    {
        try {
            $data = $this->model->getCategories();
            $error = null;
        } catch (Exception $e) {
            $data = [];
            $error = $e->getMessage();
        }

        require '../admin/category-list.php';
    }

    public function form()
    {
        $id = $_GET['id'] ?? null;
        $category = null;

        if ($id) {
            $category = $this->model->getById($id);
            if (!$category) {
                die('Category not found');
            }
        }

        require '../admin/category-add.php';
    }

    public function save()
    {
        $id = $_GET['id'] ?? null;
        $name = $_POST['name'];
        $description = $_POST['description'];

        if ($id) {
            $this->model->update($id, $name, $description);
        } else {
            $this->model->insert($name, $description);
        }

        header('Location: category-list.php');
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

        header('Location: category-list.php');
        exit;
    }
}
