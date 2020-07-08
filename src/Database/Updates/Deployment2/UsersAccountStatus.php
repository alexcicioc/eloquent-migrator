<?php

namespace App\Database\Updates\Deployment2;

use App\Database\Updates\UpdateInterface;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;

class UsersAccountStatus implements UpdateInterface
{

    public function getTableName(): string
    {
        return 'users';
    }

    public function getBlueprint(): callable
    {
        return function (Blueprint $table) {
            if (!Capsule::schema()->hasColumn($table->getTable(), 'accountStatus')) {
                $table->string('accountStatus', 64)
                    ->after('lastName')
                    ->default('active');
            } else {
                outputMessage("Table {$table->getTable()} contains this column name.");
            }
        };
    }
}
