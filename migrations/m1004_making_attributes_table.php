<?php

namespace Migration;

use Src\Application;

class m1004_making_attributes_table implements MigrationInterface
{
    public function up()
    {
        $sql = "CREATE TABLE IF NOT EXISTS 
            attributes (
                id INT AUTO_INCREMENT PRIMARY KEY,
                displayValue VARCHAR(255) NOT NULL,
                value VARCHAR(255) NOT NULL,
                set_id INT NOT NULL,
                FOREIGN KEY (set_id) REFERENCES attribute_sets(id) ON DELETE CASCADE
            ) ENGINE= INNODB;";

        $statement = Application::$app->db->prepare($sql);
        $statement->execute();
    }

    public function down()
    {
        $sql = "DROP TABLE IF EXISTS attributes;";
        $statement = Application::$app->db->prepare($sql);
        $statement->execute();
    }
}
