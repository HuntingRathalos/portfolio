<?php

namespace App\Repositories\Notification;

use Illuminate\Database\Eloquent\Collection;
// use App\Models\Notification;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class NotificationRepository implements NotificationRepositoryInterface
{
  // private $model;

  // /**
  //  * @param Notification $notification
  //  */
  // public function __construct(Notification $notification)
  // {
  //     $this->model = $notification;
  // }

  public function getNotifications(): Collection
  {
    return Auth::user()->unreadNotifications;
  }
  /**
   * 通知に既読をつける
   *
   * @param string $notificationId
   * @return void
   */
  public function readNotification(string $notificationId): void
  {
    $unreadNotification = Auth::user()
                            ->unreadNotifications
                            ->where('id', $notificationId)
                            ->first();

    if($unreadNotification) {
        $unreadNotification->markAsRead();
    }
      // $notification = $this->model->findOrFail($notificationId);
      Log::debug($unreadNotification);
      // $notification->markAsRead();
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
