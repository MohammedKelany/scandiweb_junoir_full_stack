<?php

namespace App\models;

use PDO;
use Src\Database;

class PriceModel
{
    public static function getAll($product, Database $db): array
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
