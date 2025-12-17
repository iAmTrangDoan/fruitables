<?php 
    class UserController{
        private $model;

        public function __construct($pdo)
        {
            $this->model = new UserModel($pdo);
        }

        public function delete()
        {
            // Trang quay lại (fallback nếu không có)
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
?>