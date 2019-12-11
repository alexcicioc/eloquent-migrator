<?php

namespace App\Schemas;

use Carbon\Carbon;
use Illuminate\Database\Schema\Blueprint;

class Users implements SchemaInterface
{
    public function getTableName(): string
    {
        return 'users';
    }

    public function getBlueprint(): callable
    {
        return function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('firstName', 64);
            $table->string('lastName', 64);
            $table->timestamps();
        };
    }

    public function getDefaultData(): array
    {
        return ENVIRONMENT === 'prod' ? [] : [
            [
                'firstName' => 'John',
                'lastName' => 'Snow',
                'email' => 'alex.cicioc1@gmail.com',
                'password' => '$2y$10$eiI1ONqdVHeErAis0.8Zje3WmK4ZqJ1SMoMqGMmHC4Vk1ogLTOrRS',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];
    }
}
