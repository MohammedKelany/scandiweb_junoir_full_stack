<?php

namespace Src;

use Src\Model;

abstract class DbModel extends Model
{

    abstract public function attributes(): array;
    abstract public function tableName(): string;
    public function save()
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $tableAttr = implode(",", $attributes);
        $tableVal = implode(",", array_map(fn($val) => ":$val", $attributes),);
        $sql = "INSERT INTO $tableName($tableAttr) VALUES($tableVal)";
        $statement = $this->prepere($sql);
        foreach ($attributes as $attribute) {
            $statement->bindValue(":" . $attribute, $this->{$attribute});
        }
        return $statement->execute();
    }

    abstract public static function getPrimaryKey(): string;

    public static function findOne(array $where)
    {
        $className = static::class;
        $object = new $className;
        $tableName = $object->tableName();
        $arrayKeys = array_keys($where);
        $whereArray = implode("AND", array_map(fn($m) => "$m = :$m", $arrayKeys));
        $sql = "SELECT * FROM $tableName WHERE $whereArray";
        $statement = $object->prepere($sql);
        foreach ($where as $key => $item) {
            $statement->bindValue(":$key", $item);
        }
        $statement->execute();
        return $statement->fetchObject(static::class);
    }
}
