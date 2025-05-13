<?php

namespace Migration;

use Src\Application;

class m1008_making_products_orders_table implements MigrationInterface
{
    public function up()
    {
        $sql = "CREATE TABLE IF NOT EXISTS 
            products_orders (
                id INT PRIMARY KEY AUTO_INCREMENT,
                quantity INT NOT NULL,
                product_attributes TEXT NOT NULL,
                product_id VARCHAR(50) NOT NULL,
                order_id INT NOT NULL,
                FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
                FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE
            ) ENGINE= INNODB;";

        $statement = Application::$app->db->prepare($sql);
        $statement->execute();
    }

    public function down()
    {
        $sql = "DROP TABLE IF EXISTS produtcs_orders;";
        $statement = Application::$app->db->prepare($sql);
        $statement->execute();
    }
}
