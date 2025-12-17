<?php
    session_start();
    require_once 'config/database.php';
    require_once 'models/CategoryModel.php';
    require_once 'models/OrderModel.php';
    $categories=new CategoryModel($pdo);
    $order=new OrderModel($pdo);
    $data=[];
    $error=null;
    try{
        $data=$order->getAllOrders();
    }catch(PDOException $e){
        $error=$e->getMessage();
    }
    
    foreach($data as $d)
        print_r($d);

   
?>