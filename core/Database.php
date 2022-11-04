<?php

namespace App;

use PDO;

class Database extends CallStatic
{
    public PDO $pdo;

    public function __construct(array $config)
    {
        $dsn = $config['dsn'] ?? '';
        $user = $config['user'] ?? '';
        $password = $config['password'] ?? '';

        $this->pdo = new PDO($dsn, $user, $password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function applyMigrations()
    {
        $this->createMigrationsTable();
        $appliedMigrations = $this->getApplyMigrations();

        $newMigrations = [];
        $files = scandir(Application::$ROOT_DIR . '/migrations');
        $this->ignoreMigrationsFiles($files);

        $toApplyMigrations = array_diff($files, $appliedMigrations);
        foreach ($toApplyMigrations as $migration) {
            $className = pathinfo($migration, PATHINFO_FILENAME);
            $fullPathClassName = "\App\Migration\\{$className}";
            $instance = new $fullPathClassName();
            $this->log("Apply migration {$migration}");
            $instance->up();
            $this->log("Applied migration {$migration}");
            $newMigrations[] = $className;
        }

        if (!empty($newMigrations)) {
            $this->saveMigrations($newMigrations);
        } else {
            $this->log("All migrations are applied");
        }
    }

    public function ignoreMigrationsFiles(&$files)
    {
        $ignores = ['.', '..', 'base_migration.php'];
        foreach ($files as $key => $value) {
            if (in_array($value, $ignores)) {
                unset($files[$key]);
            }
        }
    }

    public function createMigrationsTable()
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS migrations (
                id INT AUTO_INCREMENT PRIMARY KEY,
                migration VARCHAR(255),
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=INNODB;");
    }

    public function getApplyMigrations()
    {
        $statement = $this->pdo->prepare("SELECT migration FROM migrations");
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_COLUMN);
    }

    public function saveMigrations(array $migrations)
    {
        $str = implode(',', array_map(fn ($m) => "('{$m}')", $migrations));
        $statement = $this->pdo->prepare("INSERT INTO migrations (migration) VALUES
            $str
        ");
        $statement->execute();
    }

    protected function log($message)
    {
        echo '[' . date('Y-m-d H:i:s') . '] - ' . $message . PHP_EOL;
    }
}
