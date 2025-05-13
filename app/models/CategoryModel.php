<?php

namespace App\models;

use PDO;
use Src\Database;

class CategoryModel
{

    public static function getAll(Database $db): array
    {
        $statement = $db->prepare("SELECT * FROM categories");
        $statement->execute();
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    public static function getById($product, Database $db): array
    {
        $stmt = $db->prepare("SELECT * FROM categories WHERE id = :id");
        $stmt->bindValue("id", $product['category_id']);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
