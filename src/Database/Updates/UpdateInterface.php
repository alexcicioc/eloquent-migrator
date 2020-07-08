<?php


namespace App\Database\Updates;


interface UpdateInterface
{
    public function getTableName(): string;

    public function getBlueprint(): callable;
}
