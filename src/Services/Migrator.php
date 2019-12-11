<?php

namespace App\Services;

use App\Schemas\SchemaInterface;
use App\Updates\AlterInterface;
use App\Updates\UpdateInterface;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Capsule\Manager as Capsule;

class Migrator
{
    public static function createTable(SchemaInterface $schema): void
    {
        $tableName = $schema->getTableName();

        if (!Capsule::schema()->hasTable($tableName)) {
            outputMessage("Creating table $tableName");
            Capsule::schema()->create($tableName, $schema->getBlueprint());

            $defaultData = $schema->getDefaultData();
            if (!empty($defaultData)) {
                outputMessage("Adding some records in $tableName");
                Capsule::table($tableName)->insert($schema->getDefaultData());
            } else {
                outputMessage("No default data for $tableName");
            }
        } else {
            outputMessage("Table $tableName exists, skipping");
        }
    }

    public static function updateTable(object $update): void
    {
        if ($update instanceof UpdateInterface) {
            $tableName = $update->getTableName();
            outputMessage("Running updates on $tableName");
            Capsule::schema()->table($tableName, $update->getBlueprint());
        } elseif ($update instanceof AlterInterface) {
            foreach ($update->getQueries() as $query) {
                outputMessage("Running alter $query");
                Capsule::connection()->statement($query);
            }
        }
    }
}
