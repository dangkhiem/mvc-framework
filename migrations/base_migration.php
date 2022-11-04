<?php

namespace App\Migration;

class BaseMigration
{
    public function up()
    {
        $SQL = "";
        db()->pdo->exec($SQL);
    }

    public function down()
    {
        $SQL = "";
        db()->pdo->exec($SQL);
    }
}
