<?php

declare(strict_types=1);

namespace App\Models;

use PDO;
use Src\Database;

class AttributeSetModel
{
    /**
     * Get all attribute sets from the database
     *
     * @param Database $db
     * @return array<int, array<string, mixed>>
     */
    public static function getAll(Database $db): array
    {
        $statement = $db->prepare("SELECT * FROM attribute_sets");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get attribute sets (and their items) for a given product.
     *
     * @param array<string, mixed> $product
     * @param Database $db
     * @return array<int, array<string, mixed>>
     */
    public static function getById(array $product, Database $db): array
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
