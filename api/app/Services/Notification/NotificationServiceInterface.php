<?php

namespace App\Services\Notification;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

interface NotificationServiceInterface
{
    public function getNotifications(): JsonResponse;
    public function readNotification(int $notificationId): JsonResponse;
    // public function deleteNotification(int $notificationId): JsonResponse;
}
