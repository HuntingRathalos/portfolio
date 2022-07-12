<?php

namespace App\Repositories\Notification;

class NotificationRepository implements NotificationRepositoryInterface
{
  private $model;

  /**
   * @param Notification $notification
   */
  public function __construct(Notification $notification)
  {
      $this->model = $notification;
  }

  /**
   * 通知に既読をつける
   *
   * @return int $notificationId
   */
  public function readNotification(int $notificationId)
  {
      $notification = $this->model->findOrFail($notificationId);
      $notification->markAsRead();
      
      Log::debug($notification);
      return $notification
  }

  /**
   * 通知の削除
   *
   * @param int $notificationId
   * @return void
   */
  public function deleteNotification(int $notificationId): void
  {
      $this->model->destroy($notificationId);
  }
}
