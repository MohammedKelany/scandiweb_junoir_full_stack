<?php

namespace App\models;

use PDO;
use Src\Database;

class AttributeModel
{

    public static function getById($set, Database $db): array
    {
        $setStmt = $db->prepare(
            "SELECT attributes.*, attribute_sets.name as attributeName FROM
                attributes INNER JOIN
                attribute_sets ON
                attributes.set_id = attribute_sets.id WHERE
                attributes.set_id=:id;"
        );
        $setStmt->execute(['id' => $set["id"]]);
        $attributes = $setStmt->fetchAll(PDO::FETCH_ASSOC);
        return $attributes;
    }
}
