<?php
class Cart extends Db
{
    // Thêm sách vào giỏ (lưu vào session)
    public function add($book_id, $qty = 1)
    {
        if (!isset($_SESSION)) session_start();
        if (!isset($_SESSION['cart'])) $_SESSION['cart'] = array();
        if (isset($_SESSION['cart'][$book_id])) $_SESSION['cart'][$book_id] += $qty;
        else $_SESSION['cart'][$book_id] = $qty;
        return $_SESSION['cart'];
    }

    // Xóa sách khỏi giỏ
    public function remove($book_id)
    {
        if (!isset($_SESSION)) session_start();
        if (isset($_SESSION['cart'][$book_id])) {
            unset($_SESSION['cart'][$book_id]);
            return true;
        }
        return false;
    }

    // Lấy toàn bộ giỏ với thông tin sách từ DB
    public function getCart()
    {
        if (!isset($_SESSION)) session_start();
        $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
        $result = array();
        if (empty($cart)) return $result;
        $ids = array_keys($cart);
        // chuẩn bị placeholders
        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $sql = "select book_id, book_name, price, img from book where book_id in ($placeholders)";
        $rows = $this->select($sql, $ids);
        foreach ($rows as $r) {
            $bid = $r['book_id'];
            $qty = isset($cart[$bid]) ? $cart[$bid] : 0;
            $r['qty'] = $qty;
            $r['subtotal'] = $qty * $r['price'];
            $result[$bid] = $r;
        }
        return $result;
    }

    // Xóa toàn bộ giỏ
    public function clear()
    {
        if (!isset($_SESSION)) session_start();
        unset($_SESSION['cart']);
        return true;
    }
}
