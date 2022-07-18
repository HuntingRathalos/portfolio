<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
     *ユーザーに紐づく通知を取得.
     */
    public function index()
    {
        return $this->notificationService->getNotifications();
    }

    /**
     *既読履歴をつける.
     *
     * @param string $notificationId
     */
    public function read(string $notificationId)
    {
        return $this->notificationService->readNotification($notificationId);
    }
}
