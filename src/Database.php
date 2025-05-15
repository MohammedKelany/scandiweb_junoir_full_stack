<?php

namespace Src;

use PDO;

class Database
{

    protected PDO $pdo;

    public function __construct($config)
    {
        $dsn = $config["dsn"];
        $username = $config["username"];
        $password = $config["password"];
        $this->pdo = new PDO($dsn, $username, $password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function prepare(string $sql)
    {
        return $this->pdo->prepare($sql);
    }
    public function getLastInsertedId()
    {
        return $this->pdo->lastInsertId();
    }

    public function applyMigrations()
    {
        $this->createMigrationsTable();
        $appliedMigrations = $this->getAppliedMigrations();
        $files = scandir(base_path() . "migrations");
        $toApplyMigrations = array_diff($files, $appliedMigrations);
        $newMigrations = [];
        foreach ($toApplyMigrations as $migration) {
            if ($migration === "." || $migration === ".." || $migration === "MigrationInterface.php") {
                continue;
            }
            require_once base_path() . "migrations/" . $migration;
            $className = pathinfo($migration, PATHINFO_FILENAME);
            $instanse = new ("\Migration\\" . $className);
            $this->log("Appling Migration $migration");
            $instanse->up();
            $this->log("Applied Migration $migration");
            $newMigrations[] = $migration;
        }
        if (!empty($newMigrations)) {
            $this->saveNewMigrations($newMigrations);
        } else {
            echo "All Migrations Are Added";
        }
    }

    public function createMigrationsTable()
    {
        $this->pdo->exec(
            "CREATE table IF NOT EXISTS
         migrations
          (id INT AUTO_INCREMENT PRIMARY KEY,
          migration VARCHAR(255),
          created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
          ) ENGINE = INNODB;
        "
        );
    }

    public function getAppliedMigrations()
    {
        $statement = $this->pdo->prepare("SELECT migration from migrations");
        $statement->execute();
        $migrations = $statement->fetchAll(PDO::FETCH_COLUMN);
        return $migrations;
    }

    public function saveNewMigrations($migrations)
    {
        $str = implode(",", array_map(fn($m) => "('$m')", $migrations));
        $statement = $this->pdo->prepare("INSERT INTO migrations(migration) VALUES$str;");
        $statement->execute();
    }

    public function log($message)
    {
        echo "[ " . date("Y/m/d h:i:s") . " ] " . $message . PHP_EOL;
    }
}
