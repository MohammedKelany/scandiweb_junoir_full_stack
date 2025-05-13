<?php

namespace App\models;

use PDO;
use Src\Database;

class AttributeSetModel
{

    public static function getById($product, Database $db): array
    {
        $setStmt = $db->prepare("SELECT * FROM attribute_sets WHERE product_id = :product_id");
        $setStmt->execute(['product_id' => $product["id"]]);
        $sets = $setStmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($sets as &$set) {
            $set["items"] = AttributeModel::getById($set, $db);
        }
        return $sets;
    }
}
