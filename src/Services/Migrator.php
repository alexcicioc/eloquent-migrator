<?php

namespace App\Services;

use App\Database\Content\ContentInterface;
use App\Database\Schemas\SchemaInterface;
use App\Database\Updates\AlterInterface;
use App\Database\Updates\UpdateInterface;
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

    public static function addContent(ContentInterface $content): void
    {
        $tableName = $content->getTableName();

        if (!Capsule::schema()->hasTable($tableName)) {
            outputMessage("Table $tableName doesn't exist, skipping");
            return;
        }

        $data = $content->getContent();
        $strategy = $content->getStrategy();

        if (empty($data)) {
            outputMessage("Nothing to populate for $tableName");
            return;
        }

        outputMessage("Populating content in $tableName with strategy $strategy");
        if ($strategy === 'insert') {
            Capsule::table($tableName)->insert($data);
        } else if ($strategy === 'truncate-insert') {
            Capsule::table($tableName)->truncate();
            Capsule::table($tableName)->insert($data);
        } else if ($strategy === 'insert-ignore') {
            Capsule::table($tableName)->insertOrIgnore($data);
        } else {
            outputMessage("Unknown strategy $strategy");
        }
    }
}
