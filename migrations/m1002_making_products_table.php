<?php

namespace Migration;

use Src\Application;

class m1002_making_products_table implements MigrationInterface
{
    public function up()
    {
        $sql = "CREATE TABLE IF NOT EXISTS 
            products (
                id VARCHAR(50) PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                inStock BOOLEAN NOT NULL DEFAULT TRUE,
                gallery TEXT NOT NULL, -- JSON array of image URLs
                description TEXT NOT NULL,
                brand VARCHAR(255) NOT NULL,
                category_id INT NOT NULL,
                FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
            ) ENGINE= INNODB;";

        $statement = Application::$app->db->prepare($sql);
        $statement->execute();
    }
    public function down()
    {
        $sql = "DROP TABLE IF EXISTS products;";
        $statement = Application::$app->db->prepare($sql);
        $statement->execute();
    }
}
