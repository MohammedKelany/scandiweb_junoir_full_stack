<?php

namespace Migration;

use Src\Application;

class m1005_making_currencies_table implements MigrationInterface
{
    public function up()
    {
        $sql = "CREATE TABLE IF NOT EXISTS 
            currencies(
                id INT PRIMARY KEY AUTO_INCREMENT,
                label VARCHAR(10) NOT NULL,
                symbol VARCHAR(10) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL
            ) ENGINE= INNODB;";

        $statement = Application::$app->db->prepare($sql);
        $statement->execute();
    }

    public function down()
    {
        $sql = "DROP TABLE IF EXISTS currencies;";
        $statement = Application::$app->db->prepare($sql);
        $statement->execute();
    }
}
