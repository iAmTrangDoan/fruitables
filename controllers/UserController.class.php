<?php
if (!defined('ACCESS_ALLOWED')) {
    die('Direct access not allowed');
}

class UserController
{
    private $model;

    public function __construct($pdo)
    {
        $this->model = new UserModel($pdo);
    }

    public function delete()
    {
        //Quay lại trang trước đó
        $redirect = $_SERVER['HTTP_REFERER'] ?? 'index.php';

        if (!isset($_GET['id'])) {
            header("Location: {$redirect}?error=missing_id");
            exit;
        }

        $userId = (int) $_GET['id'];

        try {
            $this->model->deleteUser($userId);
            header("Location: {$redirect}");
        } catch (Exception $e) {
            $e->getMessage();
        }
        exit;
    }
}
