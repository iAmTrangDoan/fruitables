
<?php


class OrderModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function createOrder($userId, $total, $address, $phone, $note) {
        $sql = "
            INSERT INTO orders (user_id, total_amount, shipping_address, phone, note)
            VALUES (:user_id, :total, :address, :phone, :note)
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'user_id' => $userId,
            'total'   => $total,
            'address' => $address,
            'phone'   => $phone,
            'note'    => $note
        ]);

        return $this->pdo->lastInsertId();
    }

    public function addOrderItem($orderId, $productId, $price, $quantity) {
        $sql = "
            INSERT INTO order_items (order_id, product_id, price, quantity)
            VALUES (?, ?, ?, ?)
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$orderId, $productId, $price, $quantity]);
    }

    public function getAllOrders($status = null) {
        try {
            $sql = "SELECT o.*, u.first_name, u.last_name
                    FROM orders o
                    JOIN users u ON o.user_id = u.id";
            $params = [];
            
            if ($status !== null) {
                $sql .= " WHERE o.status = ?";
                $params[] = $status;
            }   
            $sql .= " ORDER BY o.id ASC";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            throw new Exception("Lỗi lấy danh sách đơn hàng: " . $e->getMessage());
        }
    }

    public function getOrdersByUser($userId) {
        $stmt = $this->pdo->prepare("
            SELECT * FROM orders
            WHERE user_id = ?
            ORDER BY order_date DESC
        ");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOrderById($orderId, $userId) {
        $stmt = $this->pdo->prepare("
            SELECT * FROM orders
            WHERE id = ? AND user_id = ?
        ");
        $stmt->execute([$orderId, $userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getOrderItems($orderId) {
        $stmt = $this->pdo->prepare("
            SELECT 
                oi.quantity,
                oi.price,
                p.name,
                p.image_url
            FROM order_items oi
            JOIN products p ON oi.product_id = p.id
            WHERE oi.order_id = ?
        ");
        $stmt->execute([$orderId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

}