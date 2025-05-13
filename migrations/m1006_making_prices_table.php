<?php

namespace Migration;

use Src\Application;

class m1006_making_prices_table implements MigrationInterface
{
    public function up()
    {
        $sql = "CREATE TABLE IF NOT EXISTS 
            prices (
                id INT AUTO_INCREMENT PRIMARY KEY,
                product_id VARCHAR(50) NOT NULL,
                currency_id INT NOT NULL,
                amount DECIMAL(10, 2) NOT NULL,
                FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
                FOREIGN KEY (currency_id) REFERENCES currencies(id) ON DELETE CASCADE
            ) ENGINE= INNODB;";

        $statement = Application::$app->db->prepare($sql);
        $statement->execute();
    }
    public function down()
    {
        $sql = "DROP TABLE IF EXISTS prices;";
        $statement = Application::$app->db->prepare($sql);
        $statement->execute();
    }
}
