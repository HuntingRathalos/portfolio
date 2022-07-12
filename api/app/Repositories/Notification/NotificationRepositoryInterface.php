<?php

namespace App\Repositories\Notification;

use Illuminate\Database\Eloquent\Collection;

interface PostRepositoryInterface
{
    // public function getNotifications(): Collection;
    // public function readNotification(DatabaseNotification $notification): Collection;
    public function deleteNotification(int $notificationId): void;

}
