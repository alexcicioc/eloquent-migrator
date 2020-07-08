<?php


namespace App\Database\Content;


interface ContentInterface
{
    public function getTableName(): string;

    public function getStrategy(): string;

    public function getContent(): array;
}
