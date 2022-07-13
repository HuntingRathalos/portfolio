<?php

namespace App\Repositories\Notification;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Notifications\DatabaseNotification;

interface NotificationRepositoryInterface
{
    public function getNotifications(): Collection;
    public function readNotification(int $notificationId): DatabaseNotification;
    // public function deleteNotification(int $notificationId): void;

}
