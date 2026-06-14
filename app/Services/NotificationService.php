<?php

namespace App\Services;

use Exception;
use Throwable;
use App\Models\User;
use App\Jobs\SendEmailJob;
use App\Models\Notification;
use App\Models\UserLoginDevice;
use App\Jobs\SendPushNotification;
use App\Models\NotificationReceiver;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Exception\FirebaseException;
use Kreait\Firebase\Exception\Messaging\NotFound;
use Kreait\Firebase\Exception\Messaging\ServerError;
use Kreait\Firebase\Messaging\Notification as FirebaseNotification;

class NotificationService
{

    /**
     *  Get Notifications
     *
     * @param  mixed $params
     * @return mixed
     */
    public static function getNotification($params = array())
    {
        try {
            $notification = Notification::select('notifications.*')
                ->when((isset($params['with_receiver']) && isset($params['user_id']) && !is_null($params['user_id'])), function ($query) use ($params) {
                    $query->selectRaw('notification_receivers.status');
                    $query->join('notification_receivers', 'notifications.id', 'notification_receivers.notification_id');
                    $query->where('receiver_id', $params['user_id']);
                })
                ->when((isset($params['with_sender']) && !is_null($params['with_sender'])), function ($query) {
                    $query->with('user:id,name,photo');
                })
                ->whereHas('receivers', function ($query) use ($params) {
                    if (isset($params['user_id']) && !is_null($params['user_id'])) {
                        $query->where('receiver_id', $params['user_id']);
                    }
                    if (isset($params['status']) && !is_null($params['status'])) {
                        $query->where('status', $params['status']);
                    }
                })
                ->orderBy('created_at', 'desc');

            // return only count
            if (isset($params['count']) && !is_null($params['count'])) {
                return $notification->count();
            }

            // return pagination for web
            if (isset($params['paginate']) && !is_null($params['paginate'])) {
                return $notification->paginate($params['paginate']);
            }

            return $notification->get();
        } catch (Throwable $e) {
            report('NotificationService ' . $e);
            return array();
        }
    }

    /**
     *  Read Notifications
     *
     * @param  mixed $params
     * @return mixed
     */
    public static function readNotification($params = array())
    {
        try {
            $notification = NotificationReceiver::where(["receiver_id" => $params['user_id'], 'status' => 0])
                ->update(['status' => 1]);

            return $notification;
        } catch (Throwable $e) {
            report('NotificationService ' . $e);
            return false;
        }
    }

    /**
     * NotificationsClear
     *
     * @author CK
     * @return mixed
     */
    public static function clearNotifications($user_id)
    {
        try {
            NotificationReceiver::where('receiver_id', $user_id)
                ->delete();

            return ['status' => 200, 'message' => trans('app.Notification_cleared_success'), 'result' => null];
        } catch (Throwable $e) {
            report('NotificationService ' . $e);
            return ['status' => 0, 'message' => trans('app.something_went_wrong'), 'result' => null];
        }
    }

    /**
     * Send Notification
     *
     * @param  mixed $params
     * @return mixed
     */
    public static function sendNotification($params = [])
    {
        try {
            $notification = Notification::create([
                'title' => $params['title'] ?? null,
                'type' => $params['type'] ?? null,
                'text' =>  $params['text'] ?? null,
                'sender_id' => $params['sender_id'] ?? null,
                'redirect_on' => $params['redirect_on'] ?? null,
            ]);

            if ($notification) {
                $receivers = [];
                if (is_array($params['receiver_id'])) {
                    foreach ($params['receiver_id'] as $receiver) {
                        $receivers[] = [
                            'receiver_id' => $receiver,
                            'status' => 0
                        ];
                    }
                } else {
                    $receivers[] = [
                        'receiver_id' => $params['receiver_id'],
                        'status' => 0
                    ];
                }

                $notification->receivers()->createMany($receivers);

                $is_send_push_noti = $params['push_noti'] ?? false;

                $params = collect($params)->except(['text', 'type', 'receiver_id', 'push_noti', 'title'])->all();

                $others = collect($params)->except(['sender_id', 'redirect_on'])->all();
                if (!empty($others)) {
                    $notification->others = json_encode($others);
                    $notification->save();
                }

                if ($is_send_push_noti) {
                    $receivers = collect($receivers)->pluck('receiver_id')->toArray();
                    NotificationService::sendPushNotifications($receivers, $notification->text, $notification->title ?? config('app.name'), $notification->type, $params);
                }
            }
        } catch (Throwable $e) {
            report('NotificationService ' . $e);
        }
    }

    /**
     * Send push notifications
     *
     * @param array $receiverIds
     * @param string $text
     * @param string $title
     * @param mixed $type
     * @param array $params
     * @return void
     */
    public static function sendPushNotifications($receiverIds = [], $text = "", $title = "", $type = null, $params = [])
    {
        try {
            UserLoginDevice::select('fcm_token')
                ->whereIn('user_id', $receiverIds)
                ->where('is_signout', 0)
                ->whereNull('logout_date')
                ->whereNotNull('fcm_token')
                ->chunk(200, function ($tokens) use ($text, $title, $type, $params) {
                    $deviceTokens = $tokens->pluck('fcm_token')->toArray();
                    $deviceTokens = array_values(array_unique($deviceTokens));

                    if (count($deviceTokens)) {
                        $badge = 0;
                        if (isset($params['badge']) && !empty($params['badge']) && $params['badge'] > 0) {
                            $badge = $params['badge'];
                        }

                        $image = $params['image'] ?? null;

                        $text = mb_substr(strip_tags($text), 0, 500);
                        $title = mb_substr(strip_tags($title), 0, 100);

                        $data = [
                            'body' => (string) base64_encode($text),
                            'title' => (string) base64_encode($title),
                            'type' => (string) $type,
                            'badge' => (string) $badge,
                            'sound' => (string) ($type == 0 ? "" : "default"),
                        ];

                        if (!empty($params)) {
                            foreach ($params as $key => $value) {
                                if (is_array($value)) {
                                    $params[$key] = json_encode($value);
                                } else {
                                    $params[$key] = (string) $value;
                                }
                            }
                            $data = array_merge($data, $params);
                        }

                        $androidConfig = [
                            'priority' => 'high',
                            'notification' => [
                                // 'image' => $image, // For some Android devices
                                'sound' => ($type == 0 ? "" : "default"),
                            ]
                        ];

                        $apnsConfig = [
                            'headers' => [
                                'apns-priority' => '10',
                            ],
                            'payload' => [
                                'aps' => [
                                    'sound' => ($type == 0 ? "" : "default"),
                                    'alert' => [
                                        'title' => $title,
                                        'body' => $text,
                                    ],
                                    'badge' => $badge,
                                    'content-available' => 1,  // Content available flag for iOS
                                    'mutable-content' => 1,
                                ],
                            ],
                            // 'fcm_options' => [
                            //     'image' => $image, // For iOS rich notification
                            // ],
                        ];

                        // For silent notification
                        // if ($type == 0) {
                        // code write here
                        // }

                        $messaging = app('firebase.messaging');

                        $notification = FirebaseNotification::create($title, $text, $image);

                        // Send notification to multiple tokens
                        $message = CloudMessage::new()
                            ->withData($data)
                            ->withNotification($notification)
                            ->withApnsConfig($apnsConfig)
                            ->withAndroidConfig($androidConfig);

                        try {
                            // Send the message to multiple tokens
                            $report = $messaging->sendMulticast($message, $deviceTokens);
                        } catch (Exception $e) {
                            report('NotificationService:CloudMessage ' . $e);
                        }

                        // Get Failed tokens
                        $failedTokens = [];
                        foreach ($report->failures()->getItems() as $failure) {
                            $failedTokens[] = $failure->target()->value();
                        }

                        // Send notification to single-single token

                        // $failedTokens = [];
                        // foreach ($deviceTokens as $key => $deviceToken) {
                        //     // Send the message to single token
                        //     $message = CloudMessage::withTarget('token', $deviceToken)
                        //         ->withNotification($notification)
                        //         ->withData($data)
                        //         ->withAndroidConfig($androidConfig)
                        //         ->withApnsConfig($apnsConfig);
                        //     try {
                        //         $res = $messaging->send($message);
                        //     } catch (NotFound $e) {
                        //         $failedTokens[] = $deviceToken;
                        //         report($e);
                        //     } catch (ServerError $e) {
                        //         $failedTokens[] = $deviceToken;
                        //         report($e);
                        //     } catch (FirebaseException $e) {
                        //         $failedTokens[] = $deviceToken;
                        //         report($e);
                        //     } catch (Exception $e) {
                        //         $failedTokens[] = $deviceToken;
                        //         report($e);
                        //     }
                        // }

                        // Delete invalid tokens from database
                        if (!empty($failedTokens)) {
                            UserLoginDevice::whereIn('fcm_token', $failedTokens)->delete();
                        }
                    }
                });
        } catch (Throwable $e) {
            report('NotificationService ' . $e);
        }
    }

    /**
     * Send Notification To User
     *
     * @param  mixed $params
     * @return mixed
     */
    public static function sendCustomNotificationToUser($params = [])
    {
        try {
            $data = [
                'status' => 0,
                'message' => trans('app.No_user_found_to_send_notification'),
                'result' => null
            ];

            $params['sender_id'] = 1;

            $notification = Notification::create([
                'title' => $params['title'] ?? null,
                'type' => $params['type'] ?? null,
                'text' =>  $params['text'] ?? null,
                'sender_id' => $params['sender_id'] ?? null,
                'redirect_on' => $params['redirect_on'] ?? null,
            ]);

            $params = collect($params)->except(['text', 'type', 'title'])->all();

            $others = collect($params)->except(['sender_id', 'redirect_on'])->all();
            if (!empty($others)) {
                $notification->others = json_encode($others);
                $notification->save();
            }

            if ($notification) {
                User::select('id')
                    ->role(USER_ROLE, 'web')
                    ->where('is_active', 1)
                    ->where('is_complete_profile', 1)
                    ->withCount([
                        'login_devices' => function ($query) {
                            $query->where('is_signout', 0);
                        }
                    ])
                    ->chunk(100, function ($users) use ($notification, &$data, $params) {
                        $receivers = [];
                        foreach ($users as $receiver) {
                            $receivers[] = [
                                'receiver_id' => $receiver->id,
                                'status' => 0
                            ];
                        }

                        $notification->receivers()->createMany($receivers);

                        $receivers = collect($users)->where('login_devices_count', '>', 0)->pluck('id')->toArray();
                        if ($receivers) {
                            dispatch(new SendPushNotification($receivers, $notification->text, $notification->title ?? config('app.name'), $notification->type, $params));
                        }

                        if ($data['status'] != 200) {
                            $data['status'] = 200;
                            $data['message'] = trans('app.Notification_send_success');
                        }
                    });
            }
        } catch (Throwable $e) {
            report('NotificationService ' . $e);
        }
        return $data;
    }

    /**
     * Send Notification To User
     *
     * @param  mixed $params
     * @return mixed
     */
    public static function sendEmailNotification($params = [])
    {
        try {
            $data = [
                'status' => 0,
                'message' => trans('app.No_user_found_to_send_notification'),
                'result' => null
            ];

            User::select('id', 'name', 'email')
                ->where(function ($query) {
                    $query->whereHas('notification_preferences', function ($query) {
                        $query->where('type', 1);
                        $query->where('status', 1);
                    });
                    $query->orWhereDoesntHave('notification_preferences', function ($query) {});
                })
                ->role(USER_ROLE, 'web')
                ->where('is_active', 1)
                ->where('is_complete_profile', 1)
                ->chunk(100, function ($users) use (&$data, $params) {
                    foreach ($users as $user) {
                        $mail_data = [
                            'email_id' => 8,
                            'user_name' => $user->name,
                            'user_email' => $user->email,
                            'user_id' => $user->id,
                            'title' => $params['title'] ?? "",
                            'text' => $params['text'] ?? "",
                        ];
                        dispatch(new SendEmailJob($mail_data));
                    }

                    if ($data['status'] != 200) {
                        $data['status'] = 200;
                        $data['message'] = trans('app.Notification_send_success');
                    }
                });
        } catch (Throwable $e) {
            report('NotificationService ' . $e);
        }
        return $data;
    }
}
