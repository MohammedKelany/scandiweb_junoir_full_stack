<?php

declare(strict_types=1);

namespace App\Models;

use Exception;
use PDO;
use Src\Database;

class OrderModel
{
    /**
     * Get all orders from the database
     *
     * @param Database $db
     * @return array<int, array<string, mixed>>
     */
    public static function getAll(Database $db): array
    {
        $statement = $db->prepare("SELECT * FROM orders");
        $statement->execute();
        $orders = $statement->fetchAll(PDO::FETCH_ASSOC);

        foreach ($orders as &$order) {
            $order["products"] = OrderItemModel::getAll($order, $db);
        }
        return $orders;
    }

    /**
     * Get an order by its ID
     *
     * @param array<string, mixed> $args
     * @param Database $db
     * @return array<string, mixed>
     * @throws Exception
     */
    public static function getById(array $args, Database $db): array
    {
        $statement = $db->prepare("SELECT * FROM orders WHERE id = :id");
        $statement->bindValue("id", $args["id"]);
        $statement->execute();
        $order = $statement->fetch(PDO::FETCH_ASSOC);
        if (!$order) {
            throw new Exception("Order with this id doesn't exist!", 404);
        }
        return $order;
    }

    /**
     * Add a new order into the database.
     *
     * @param array<string, mixed> $args
     * @param Database $db
     * @return array<string, mixed>
     * @throws \Exception
     */
    public static function addOrder(array $args, Database $db): array
    {
        $items = $args['input']['items'];
        $totalPrice = 0;

        foreach ($items as $item) {
            $stmt = $db->prepare("SELECT amount FROM prices WHERE product_id = ?");
            $stmt->execute([$item['productId']]);
            $price = $stmt->fetchColumn();

            if (!$price) {
                throw new \Exception("Invalid product ID: {$item['productId']}");
            }

            $totalPrice += $price * $item['quantity'];
        }

        $stmt = $db->prepare("INSERT INTO orders (total_price) VALUES (?)");
        $stmt->execute([$totalPrice]);
        $orderId = $db->getLastInsertedId();

        foreach ($items as $item) {
            $attributes = $item["productAttributes"];
            $stmt = $db->prepare("
                        INSERT INTO products_orders (product_id, product_attributes, order_id, quantity)
                        VALUES (?, ?, ?, ?)
                        ");
            $stmt->execute([
                $item['productId'],
                json_encode($attributes),
                $orderId,
                $item['quantity']
            ]);
        }

        return [
            'id' => $orderId,
            'total_price' => $totalPrice,
            'created_at' => date('Y-m-d H:i:s')
        ];
    }
}
