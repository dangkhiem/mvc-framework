<?php

namespace App\Migration;

class m221104_095749_CreateUsersTable
{
    public function up()
    {
        $SQL = "CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            email VARCHAR(255) NOT NULL,
            password VARCHAR(512) NOT NULL,
            firstname VARCHAR(255) NOT NULL,
            lastname VARCHAR(255) NOT NULL,
            status TINYINT NOT NULL DEFAULT true,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=INNODB;";
        db()->pdo->exec($SQL);
    }

    public function down()
    {
        $SQL = "DROP TABLE users;";
        db()->pdo->exec($SQL);
    }
}
