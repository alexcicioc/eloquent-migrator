<?php


namespace App\Schemas;


interface SchemaInterface
{
    public function getTableName(): string;

    public function getBlueprint(): callable;

    public function getDefaultData(): array;
}
