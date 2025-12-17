<?php
session_start();
require_once 'config/database.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$orderModel = new OrderModel($pdo);
$userId = $_SESSION['user_id'];

if (isset($_GET['id'])) {
    // Xem chi tiết đơn vừa đặt
    $orderId = (int)$_GET['id'];
    $order = $orderModel->getOrderById($orderId, $userId);  
    $orderItems = $orderModel->getOrderItems($orderId);

    require 'order-success.php';
} else {
    // Xem lịch sử đơn hàng
    $orders = $orderModel->getOrdersByUser($userId);

    foreach ($orders as &$o) {
        $o['items'] = $orderModel->getOrderItems($o['id']);
    }

    require 'order-history.php';
}
