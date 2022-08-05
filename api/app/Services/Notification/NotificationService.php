<?php

namespace App\Services\Notification;

use App\Repositories\Notification\NotificationRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class NotificationService implements NotificationServiceInterface
{
    private $notificationRepository;

    /**
     * @param NotificationRepositoryInterface $notificationRepository
     */
    public function __construct(NotificationRepositoryInterface $notificationRepository)
    {
        $this->notificationRepository = $notificationRepository;
    }

    /**
     * ユーザーに紐づく通知を取得.
     *
     * @return JsonResponse
     */
    public function getNotifications(): JsonResponse
    {
        $notifications = $this->notificationRepository->getNotifications();

        return response()->json($notifications, Response::HTTP_OK);
    }

    /**
     *通知に既読をつける.
     *
     * @param string $notificationId
     *
     * @return JsonResponse
     */
    public function readNotification(string $notificationId): JsonResponse
    {
        $this->notificationRepository->readNotification($notificationId);

        return response()->json(null, Response::HTTP_OK);
    }
}
