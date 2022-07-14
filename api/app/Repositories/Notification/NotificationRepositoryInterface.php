<?php

namespace App\Repositories\Notification;

use Illuminate\Database\Eloquent\Collection;

interface NotificationRepositoryInterface
{
    public function getNotifications(): Collection;
    public function readNotification(string $notificationId): void;

}
