<?php

namespace App\Models;

use PDO;
use Src\Database;

class OrderItemModel
{
    public static function getAll($order, Database $db): array
    {
        $itemsStmt = $db->prepare("SELECT * FROM products_orders WHERE order_id = :id");
        $itemsStmt->bindValue("id", $order['id']);
        $itemsStmt->execute();
        $items = $itemsStmt->fetchAll(PDO::FETCH_ASSOC);
        return $items;
    }
}
