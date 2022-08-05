<?php

namespace App\Services\Notification;

use Illuminate\Http\JsonResponse;

interface NotificationServiceInterface
{
    public function getNotifications(): JsonResponse;

    public function readNotification(string $notificationId): JsonResponse;
}
