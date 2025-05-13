<?php

namespace Migration;

use Src\Application;

class m1003_making_attribute_sets_table implements MigrationInterface
{
    public function up()
    {
        $sql = "CREATE TABLE IF NOT EXISTS 
            attribute_sets(
            id INT PRIMARY KEY AUTO_INCREMENT,
            name VARCHAR(255) NOT NULL,
            type VARCHAR(255) NOT NULL,
            product_id VARCHAR(50) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
            FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
        ) ENGINE= INNODB;";

        $statement = Application::$app->db->prepare($sql);
        $statement->execute();
    }

    public function down()
    {
        $sql = "DROP TABLE IF EXISTS attribute_sets;";
        $statement = Application::$app->db->prepare($sql);
        $statement->execute();
    }
}
