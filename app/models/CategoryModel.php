<?php

declare(strict_types=1);

namespace App\Models;

use PDO;
use Src\Database;

class CategoryModel
{
    /**
     * Get all categories from the database.
     *
     * @param Database $db
     * @return array<int, array<string, mixed>>
     */
    public static function getAll(Database $db): array
    {
        $statement = $db->prepare("SELECT * FROM categories");
        $statement->execute();
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    /**
     * Get a category by its ID (using a product's category_id).
     *
     * @param array<string, mixed> $product
     * @param Database $db
     * @return array<string, mixed>
     */
    public static function getById(array $product, Database $db): array
    {
        $stmt = $db->prepare("SELECT * FROM categories WHERE id = :id");
        $stmt->bindValue("id", $product['category_id']);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
