<?php
    session_start();
    require_once 'config/database.php';

    $controller = new ShopController($pdo);
    $shopData = $controller->loadData();

    if(isset($shopData['error'])){
        echo "<p>Error: ".$shopData['error']."</p>";
        exit();
    }
    
    $categories=$shopData['categories']??[];
    $products=$shopData['products']??[];

    // foreach($categories as $object)
    //     print_r($object);
     foreach($shopData as $data)
        print_r($data);


   
?>