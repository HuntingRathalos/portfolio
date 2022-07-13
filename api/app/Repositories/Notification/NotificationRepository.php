<?php

namespace App\Repositories\Notification;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;

class NotificationRepository implements NotificationRepositoryInterface
{
  private $model;

  /**
   * @param DatabaseNotification $notification
   */
  public function __construct(DatabaseNotification $notification)
  {
      $this->model = $notification;
  }

  public function getNotifications(): Collection
  {
    return Auth::user()->notifications;
  }
  /**
   * 通知に既読をつける
   *
   * @param int $notificationId
   * @return DatabaseNotification $notification
   */
  public function readNotification(int $notificationId)
  {
      $notification = $this->model->findOrFail($notificationId);
      $notification->markAsRead();
      return $notification;
  }

  // /**
  //  * 通知の削除
  //  *
  //  * @param int $notificationId
  //  * @return void
  //  */
  // public function deleteNotification(int $notificationId): void
  // {
  //     $this->model->destroy($notificationId);
  // }
}
