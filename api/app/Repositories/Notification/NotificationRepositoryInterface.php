<?php

namespace App\Repositories\Notification;

use Illuminate\Database\Eloquent\Collection;

interface NotificationRepositoryInterface
{
    // public function getNotifications(): Collection;
    public function readNotification(int $notificationId): Collection;
    public function deleteNotification(int $notificationId): void;

}
