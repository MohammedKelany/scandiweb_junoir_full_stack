<?php

namespace App\models;

use Exception;
use PDO;
use Src\Database;

class ProductModel
{

    public static function getAll(Database $db): array
    {
        $statement = $db->prepare("SELECT * FROM products");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($args, $db): array
    {
        $statement = $db->prepare("SELECT * FROM products WHERE id= :id");

        $statement->bindValue("id", $args["id"]);
        $statement->execute();
        $product = $statement->fetch(PDO::FETCH_ASSOC);
        if (!$product) {
            throw new  Exception("Product with this id doesn't Exist !!", 404);
        } else {
            return $product;
        }
    }
}
