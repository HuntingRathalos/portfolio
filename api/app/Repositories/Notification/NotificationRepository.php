<?php

namespace App\Repositories\Notification;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class NotificationRepository implements NotificationRepositoryInterface
{
    /**
     * 未読通知を取得する.
     *
     * @return Collection
     */
    public function getNotifications(): Collection
    {
        return Auth::user()->unreadNotifications;
    }

    /**
     * 通知に既読をつける.
     *
     * @param string $notificationId
     */
    public function readNotification(string $notificationId): void
    {
        $unreadNotification = Auth::user()
            ->unreadNotifications
            ->where('id', $notificationId)
            ->first();

        if ($unreadNotification) {
            $unreadNotification->markAsRead();
        }
    }
}
