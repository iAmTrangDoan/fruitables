<?php 

    class OrderController{
        protected $pdo;
        protected $orderModel;
        protected $cartModel;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->orderModel = new OrderModel($pdo);
        $this->cartModel  = new CartModel($pdo);
    }

    public function handle() {
        $userId = $_SESSION['user_id'];

        // 1. Lấy dữ liệu form
        $address = $_POST['address'] . ', ' . $_POST['city'] ;
        $phone   = $_POST['phone'];
        $note    = $_POST['note'] ?? '';

        // 2. Lấy giỏ hàng
        $cartItems = $this->cartModel->getCartByUser($userId);
        if (empty($cartItems)) {
            header("Location: cart.php");
            exit;
        }

        // 3. Tính tổng tiền
        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // 4. Transaction
        $this->pdo->beginTransaction();
        try {
            // 5. Tạo order
            $orderId = $this->orderModel->createOrder(
                $userId,
                $total + 25000,
                $address,
                $phone,
                $note
            );

            // 6. Tạo order_items
            foreach ($cartItems as $item) {
                $this->orderModel->addOrderItem(
                    $orderId,
                    $item['product_id'],
                    $item['price'],
                    $item['quantity']
                );
            }

            // 7. Xóa giỏ hàng
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
?>