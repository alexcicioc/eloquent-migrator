<?php


namespace App\Database\Updates;


interface AlterInterface
{
    public function getQueries(): array ;
}
