<?php

class CartController {
    private $model;

    public function __construct($pdo) {
        $this->model = new CartModel($pdo);
    }

    public function index() {
        
        $cartItems = $this->model->getCartByUser($_SESSION['user_id']);
        require './cart-list.php';
    }

    public function add() {
        $this->model->addOrUpdate(
            $_SESSION['user_id'],
            $_POST['product_id']
        );
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }

    public function remove() {
        $this->model->remove($_GET['id']);
        header("Location: cart.php");
    }


}

?>
