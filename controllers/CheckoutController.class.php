<?php 
    class CheckoutController {
        protected $cartModel;

        public function __construct($pdo) {
            $this->cartModel = new CartModel($pdo);
        }

        public function index() {
            $userId = $_SESSION['user_id'];
            $cartItems = $this->cartModel->getCartByUser($userId);

            if (empty($cartItems)) {
                header("Location: cart.php");
                exit;
            }

            require './checkout-list.php';
        }
    }

?>