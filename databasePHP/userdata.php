<?php


require_once "../databasePHP/connection.php";
$query = "
SELECT
    u.username AS user_name,
    u.room_num AS room_number,
    p.productName AS product_name,
    od.price AS product_price,
    od.quantity AS quantity,
    (od.price * od.quantity) AS total_product_price,
    o.total_price AS total_order_price,
    o.order_date,
    o.status,
    o.order_id
FROM
    orders o
JOIN
    users u ON o.user_id = u.user_id
JOIN
    order_details od ON o.order_id = od.order_id
JOIN
    products p ON od.product_id = p.product_id
ORDER BY
    o.order_date DESC;
";

$statement = $connection->prepare($query);
$statement->execute();
$orders = $statement->fetchAll(PDO::FETCH_ASSOC);
