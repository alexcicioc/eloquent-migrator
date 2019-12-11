<?php

namespace App\Schemas;

use Carbon\Carbon;
use Illuminate\Database\Schema\Blueprint;

class UserNotifications implements SchemaInterface
{
    public function getTableName(): string
    {
        return 'userNotifications';
    }

    public function getBlueprint(): callable
    {
        return function (Blueprint $table) {
            $table->increments('id');
            $table->text('text');
            $table->unsignedInteger('referenceId');
            $table->unsignedInteger('userId');
            $table->enum('status', ['unread', 'seen', 'read'])->default('unread');
            $table->timestamps();
            $table->foreign('userId')
                ->references('id')->on('users')
                ->onDelete('cascade');
        };
    }

    public function getDefaultData(): array
    {
        return [];
    }
}
