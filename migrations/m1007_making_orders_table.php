<?php

namespace Migration;

use Src\Application;

class m1007_making_orders_table implements MigrationInterface
{
    public function up()
    {
        $sql = "CREATE TABLE IF NOT EXISTS 
            orders (
                id INT AUTO_INCREMENT PRIMARY KEY, 
                total_price INT NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE= INNODB;";

        $statement = Application::$app->db->prepare($sql);
        $statement->execute();
    }
    public function down()
    {
        $sql = "DROP TABLE IF EXISTS orders;";
        $statement = Application::$app->db->prepare($sql);
        $statement->execute();
    }
}
