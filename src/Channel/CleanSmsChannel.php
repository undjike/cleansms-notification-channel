<?php

/*
 * CleanSmsChannel.php
 *
 *  @author    Ulrich Pascal Ndjike Zoa <ndjikezoaulrich@gmail.com>
 *  @project    cleansms-notification-channel
 *
 *  Copyright 2020
 *  27/08/2020 18:21
 */

namespace Undjike\CleanSmsNotificationChannel\Channel;

use Exception;
use Illuminate\Notifications\Notification;
use Undjike\CleanSmsNotificationChannel\CleanSmsMessage;
use Undjike\CleanSmsNotificationChannel\Exceptions\CouldNotSendNotification;
use Undjike\CleanSmsPhp\CleanSms;

class CleanSmsChannel
{
    /**
     * @param $notifiable
     * @param Notification $notification
     * @throws CouldNotSendNotification
     * @noinspection PhpUndefinedMethodInspection
     */
    public function send($notifiable, Notification $notification)
    {
        if (!$recipient = $notifiable->routeNotificationFor('CleanSms')) return;

        $message = $notification->toCleanSms($notifiable);

        try {
            if ($message instanceof CleanSmsMessage) $content = $message->getBody();
            elseif (is_string($message)) $content = trim($message);
            else throw new Exception(__('Required string or CleanSmsMessage instance.'));

            if (empty($content)) throw new Exception(__('Can\'t send a message with an empty body.'));

            $result = CleanSms::create()
                ->apiKey(config('services.cleansms.apikey'))
                ->email(config('services.cleansms.email'))
                ->sendSms($content, $recipient);

            if ((int) $result != 1) throw new Exception(__('Could not send the message.'));
        }
        catch (Exception $e) {
            throw CouldNotSendNotification::serviceRespondedWithAnError($e->getMessage());
        }
    }
}