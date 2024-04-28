<?php

namespace App\Services;

use App\Models\ActivityLog;

class ActivityLogger
{
    public static function logCreatedTask($userId, $description)
    {
        self::log($userId, 'created', $description);
    }

    public static function logUpdatedTask($userId, $description)
    {
        self::log($userId, 'updated', $description);
    }

    public static function logDeletedTask($userId, $description)
    {
        self::log($userId, 'deleted', $description);
    }

    private static function log($userId, $action, $description = null)
    {
        ActivityLog::create([
            'user_id' => $userId,
            'action' => $action,
            'description' => $description,
        ]);
    }
}