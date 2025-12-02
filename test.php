<?php
    session_start();
    define('ACCESS_ALLOWED', true);
    require_once 'config/database.php';

    $controller = new ShopController($pdo);
    $shopData = $controller->loadData();

    if(isset($shopData['error'])){
        echo "<p>Error: ".$shopData['error']."</p>";
        exit();
    }
    
    $categories=$shopData['categories']??[];
    $products=$shopData['products']??[];

    foreach($categories as $object)
        echo $object['product_count'];
?>