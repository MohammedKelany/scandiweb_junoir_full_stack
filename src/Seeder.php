<?php

namespace Src;

use Configration\Config;

class Seeder extends Database
{
    public static function getCategoryId($categoryName)
    {
        $pdo = (new static((new Config())->DB_CONFIG))->pdo;
        $statement = $pdo->prepare("SELECT DISTINCT id from categories where name = :name ");
        $statement->bindValue("name", $categoryName);
        $statement->execute();
        return $statement->fetchColumn();
    }

    public static function seed()
    {
        //loading the data from the provided file
        $content = json_decode(file_get_contents("data.json", true), true);

        $products = $content["data"]["products"];
        $categories = $content["data"]["categories"];

        $pdo = Application::$app->db->pdo;

        foreach ($categories as $category) {
            // 1. Insert category
            $categoryStmt = $pdo->prepare("INSERT INTO categories (name) VALUES (:name)");
            $categoryStmt->execute(['name' => $category["name"]]);
        }

        foreach ($products as $product) {
            $productId = $product["id"];
            // 2. Insert currencies
            $currencyStmt = $pdo->prepare("INSERT INTO currencies (label, symbol) VALUES (:label, :symbol)");
            foreach ($product['prices'] as $price) {
                $currencyStmt->execute([
                    'label' => $price['currency']["label"],
                    'symbol' => $price['currency']["symbol"]
                ]);
            }
            $currencyId = $pdo->lastInsertId();

            // 3. Insert product
            $productStmt = $pdo->prepare("
                        INSERT INTO products (id,name, inStock, gallery, description, brand, category_id) 
                        VALUES (:id,:name, :inStock, :gallery, :description, :brand, :category_id)
                        ");

            $productStmt->execute([
                "id" => $product["id"],
                'name' => $product['name'],
                'inStock' => $product['inStock'],
                'gallery' => json_encode($product['gallery']),
                'description' => $product['description'],
                'brand' => $product['brand'],
                'category_id' => self::getCategoryId($product["category"]),
            ]);

            $setStmt = $pdo->prepare("INSERT INTO attribute_sets (name, type, product_id) VALUES (:name, :type,:product_id)");
            foreach ($product['attributes'] as $attribute) {
                // 4. Insert attribute set
                $setStmt->execute([
                    'name' => $attribute['name'],
                    'type' => $attribute['type'],
                    'product_id' => $productId,
                ]);
                $setId = $pdo->lastInsertId();
                // 5. Insert attributes
                foreach ($attribute["items"] as $value) {
                    $attributeStmt = $pdo->prepare("INSERT INTO attributes (displayValue, value, set_id) VALUES (:displayValue, :value, :set_id)");
                    $attributeStmt->execute([
                        'displayValue' => $value["value"],
                        'value' => $value["value"],
                        'set_id' => $setId
                    ]);
                }
            }

            // 6. Insert prices
            $priceStmt = $pdo->prepare("
                        INSERT INTO prices (product_id, amount,currency_id) 
                        VALUES (:product_id, :amount, :currency_id)
                         ");
            foreach ($product['prices'] as $price) {
                $priceStmt->execute([
                    'product_id' => $productId,
                    'currency_id' => $currencyId,
                    'amount' => $price['amount'],
                ]);
            }

            echo "Product seeded successfully with ID: $productId <br>";
        }
    }
}
