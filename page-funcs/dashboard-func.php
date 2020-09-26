<?php

require 'classes/DB.php';
require 'variables/dbConfig.php';

$db = new DB($dbConfig);

function pendingOrders($userIdPendingOrders){

    global $db;

    $pendingOrders = (object)[
        'orders' => [],
        'products' => []
    ];
    
    $pendingOrders->orders = $db->fetchRows("SELECT id,delivery,orderTotal FROM ORDERS WHERE (USERID = ? AND DELIVERED = 0)",[$userIdPendingOrders]);

    foreach ($pendingOrders->orders as $key => $order) {

        $pendingOrders->products[$key] = pendingOrdersProductsIds($order->id);

        foreach ($pendingOrders->products[$key] as $prodKey => $product) {

            $productData = getProduct($product->productId);

            $product->fileName = $productData->fileName;
            $product->name = $productData->Name;
            $product->price = $productData->Price;
        }
        
    }

    return $pendingOrders;
}

function pendingOrdersProductsIds($orderId){

    global $db;

    return $db->fetchRows("SELECT productId FROM orderedProducts WHERE ORDERID = ?", [$orderId]);
}

function getProduct($productId){

    global $db;

    return $db->fetchRow("SELECT fileName,Name,Price  FROM Products WHERE ID = ?", [$productId]);
}

function orderHistory($userIdOrderHistory){

    global $db;

    $orderHistory = (object)[
        'orders' => []
    ];
    
    $orderHistory->orders = $db->fetchRows("SELECT id,orderTotal,deliveryDate 
                            FROM ORDERS 
                            WHERE (USERID = ? AND DELIVERED = 1)", 
                            [$userIdOrderHistory]);
    return $orderHistory;
}

function formatDate($date){

    $phpdate = strtotime($date);
    $formatedDate = date( 'd.m.Y', $phpdate );

    return $formatedDate;
}