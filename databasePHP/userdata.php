<?php


require_once "../databasePHP/connection.php";

$query = "
    SELECT
        u.username,
        u.room_num,
        p.productName,
        p.price,
        o.total_price,
        o.order_date,
        o.order_id,
        o.notes
    FROM
        orders o
    JOIN
        users u ON o.user_id = u.user_id
    JOIN
        products p ON o.product_id = p.product_id
    ORDER BY
        o.order_date DESC
";

$statement = $connection->prepare($query);
$statement->execute();
$orders = $statement->fetchAll(PDO::FETCH_ASSOC);
