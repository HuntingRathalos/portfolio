<?php

namespace App\Repositories\Notification;

use Illuminate\Database\Eloquent\Collection;
// use App\Models\Notification;

interface NotificationRepositoryInterface
{
    public function getNotifications(): Collection;
    public function readNotification(string $notificationId): void;
    // public function deleteNotification(int $notificationId): void;

}
