<?php

declare(strict_types=1);

namespace App\Models;

use PDO;
use Src\Database;

class PriceModel
{
    /**
     * Get all prices for a given product from the database.
     *
     * @param array<string, mixed> $product
     * @param Database $db
     * @return array<int, array<string, mixed>>
     */
    public static function getAll(array $product, Database $db): array
    {
        $stmt = $db->prepare("SELECT * FROM prices WHERE product_id = :id");
        $stmt->bindValue("id", $product['id']);
        $stmt->execute();
        $prices = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($prices as &$price) {
            $stmt = $db->prepare("SELECT * FROM currencies WHERE id = :currency_id");
            $stmt->bindValue("currency_id", $price['currency_id']);
            $stmt->execute();
            $price['currency'] = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        return $prices;
    }
}
