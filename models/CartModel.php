<?php
if (!defined('ACCESS_ALLOWED')) {
    die('Direct access not allowed');
}

class CartModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getCartByUser($userId) {
          $sql = "
            SELECT 
                c.id AS cart_id,
                c.quantity,
                p.id AS product_id,
                p.name,
                p.price,
                p.image_url
            FROM cart c
            JOIN products p ON c.product_id = p.id
            WHERE c.user_id = :user_id
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addOrUpdate($userId, $productId,$quantity = 1) {

        $sql = "SELECT id FROM cart 
                WHERE user_id = :u AND product_id = :p";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['u'=>$userId, 'p'=>$productId]);

        if ($stmt->fetch()) {
            $sql = "UPDATE cart 
                    SET quantity = quantity + 1
                    WHERE user_id = :u AND product_id = :p";
        } else {
            $sql = "INSERT INTO cart (user_id, product_id, quantity)
                    VALUES (:u, :p, 1)";
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['u'=>$userId, 'p'=>$productId]);

    }

    public function remove($cartId) {
        $stmt = $this->pdo->prepare(
            "DELETE FROM cart WHERE id = :id"
        );
        $stmt->execute(['id'=>$cartId]);
    }

    public function clearCart($userId) {
        $sql = "DELETE FROM cart WHERE user_id = :user_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['user_id' => $userId]);
    }

}

?>

