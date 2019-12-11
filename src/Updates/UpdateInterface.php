<?php


namespace App\Updates;


interface UpdateInterface
{
    public function getTableName(): string;

    public function getBlueprint(): callable;
}
