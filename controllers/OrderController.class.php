<?php
if (!defined('ACCESS_ALLOWED')) {
    die('Direct access not allowed');
}


class OrderController
{
    protected $pdo;
    protected $orderModel;
    protected $cartModel;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
        $this->orderModel = new OrderModel($pdo);
        $this->cartModel  = new CartModel($pdo);
    }

    public function handle()
    {
        $userId = $_SESSION['user_id'];

        $address = $_POST['address'] . ', ' . $_POST['city'];
        $phone   = $_POST['phone'];
        $note    = $_POST['note'] ?? '';

        $cartItems = $this->cartModel->getCartByUser($userId);
        if (empty($cartItems)) {
            header("Location: cart.php");
            exit;
        }

        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $this->pdo->beginTransaction();
        try {
            $orderId = $this->orderModel->createOrder(
                $userId,
                $total + 25000,
                $address,
                $phone,
                $note
            );

            foreach ($cartItems as $item) {
                $this->orderModel->addOrderItem(
                    $orderId,
                    $item['product_id'],
                    $item['price'],
                    $item['quantity']
                );
            }

            $this->cartModel->clearCart($userId);

            $this->pdo->commit();

            header("Location: orders.php?id=" . $orderId);
            exit;
        } catch (Exception $e) {
            $this->pdo->rollBack();
            die("Order failed: " . $e->getMessage());
        }
    }
}
