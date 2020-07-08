<?php


namespace App\Database\Content;


class UserNotifications implements ContentInterface
{
    public function getTableName(): string
    {
        return 'userNotifications';
    }

    public function getStrategy(): string
    {
        return 'truncate-insert';
    }

    public function getContent(): array
    {
        return [
            [
                'text' => 'Test notification',
                'referenceId' => 1,
                'userId' => 1,
            ],
            [
                'text' => 'Test notification2',
                'referenceId' => 1,
                'userId' => 1,
            ],
        ];
    }
}
