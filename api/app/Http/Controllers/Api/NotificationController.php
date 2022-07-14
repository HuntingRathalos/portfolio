<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Notification\NotificationServiceInterface;


class NotificationController extends Controller
{
    private $notificationService;

    /**
     * @param NotificationServiceInterface $notificationService
     */
    public function __construct(NotificationServiceInterface $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    /**
     *ユーザーに紐づく通知を取得
     *
     * @return void
     */
    public function index()
    {
        return $this->notificationService->getNotifications();
    }

    /**
     *既読履歴をつける
     *
     * @param string $notificationId
     * @return void
     */
    public function read(string $notificationId)
    {
        return $this->notificationService->readNotification($notificationId);
    }
    // /**
    //  *既読履歴をつける
    //  *
    //  * @param DatabaseNotification $notification
    //  * @return void
    //  */
    // public function read(DatabaseNotification $notification)
    // {
    //     return $this->notificationService->readNotification();
    // }
    // /**
    //  *既読履歴を外す
    //  *
    //  * @return void
    //  */
    // public function unread(DatabaseNotification $notification)
    // {
    //     return $this->notificationService->unreadNotification();
    // }

    // /**
    //  *通知を削除する
    //  *
    //  * @return void
    //  */
    // public function delete(int $notificationId)
    // {
    //     return $this->notificationService->deleteNotification($notificationId);
    // }
}
