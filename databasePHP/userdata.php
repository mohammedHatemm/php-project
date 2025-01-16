<?php


require_once "../databasePHP/connection.php";
 $query ="SELECT
    u.username AS user_name,
    u.user_img AS user_image,
    o.order_id AS order_number,
    r.room_id AS room_number,
    r.price AS room_price,
    o.total_price AS total_price,
    o.status AS order_status,
    p.productName AS product_name,
    od.quantity AS product_quantity
FROM
    orders o
JOIN
    users u ON o.user_id = u.user_id
JOIN
    rooms r ON o.room_id = r.room_id
JOIN
    order_details od ON o.order_id = od.order_id
JOIN
    products p ON od.product_id = p.product_id; ";


$result = $connection -> prepare($query);
$result->execute();
$orders = $result->fetchAll(PDO::FETCH_ASSOC);

