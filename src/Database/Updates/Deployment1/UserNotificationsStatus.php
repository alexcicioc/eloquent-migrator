<?php

namespace App\Database\Updates\Deployment1;

use App\Database\Updates\AlterInterface;

class UserNotificationsStatus implements AlterInterface
{
    public function getQueries(): array
    {
        return [
            "ALTER TABLE `userNotifications` 
             CHANGE `status` `status` VARCHAR(32) 
             CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL 
             DEFAULT 'unread';"
        ];
    }
}
