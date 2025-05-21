<?php

declare(strict_types=1);

namespace App\Models;

use Exception;
use PDO;
use Src\Database;

class ProductModel
{
    /**
     * Get all products from the database
     *
     * @param Database $db Database connection
     * @return array<int, array<string, mixed>>
     */
    public static function getAll(Database $db): array
    {
        $statement = $db->prepare("SELECT * FROM products");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get a product by its ID
     *
     * @param array<string, mixed> $args Arguments containing product ID
     * @param Database $db Database connection
     * @return array<string, mixed>
     * @throws Exception When product is not found
     */
    public static function getById(array $args, Database $db): array
    {
        $statement = $db->prepare("SELECT * FROM products WHERE id = :id");
        $statement->bindValue("id", $args["id"]);
        $statement->execute();

        $product = $statement->fetch(PDO::FETCH_ASSOC);
        if (!$product) {
            throw new Exception("Product with this id doesn't exist!", 404);
        }

        return $product;
    }
}
