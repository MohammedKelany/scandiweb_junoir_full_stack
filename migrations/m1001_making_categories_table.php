<?php

namespace Migration;

use Src\Application;

class m1001_making_categories_table implements MigrationInterface
{
    public function up()
    {
        $sql = "CREATE TABLE IF NOT EXISTS 
            categories(
            id INT PRIMARY KEY AUTO_INCREMENT,
            name VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL
        ) ENGINE= INNODB;";

        $statement = Application::$app->db->prepare($sql);
        $statement->execute();
    }
    public function down()
    {
        $sql = "DROP TABLE IF EXISTS categories";
        $statement = Application::$app->db->prepare($sql);
        $statement->execute();
    }
}
