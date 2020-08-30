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
        try {
            if (!$recipient = $notifiable->routeNotificationFor('CleanSms'))
                throw new Exception(__('Your notifiable instance does not have function routeNotificationForCleanSms.'));

            $message = $notification->toCleanSms($notifiable);

            if ($message instanceof CleanSmsMessage) {
                $content = $message->getBody();
                $transactional = $message->isTransactional();
            }
            elseif (is_string($message)) $content = trim($message);
            else throw new Exception(__('Required string or CleanSmsMessage instance.'));

            if (empty($content)) throw new Exception(__('Can\'t send a message with an empty body.'));

            $result = CleanSms::create()
                ->apiKey(config('services.cleansms.apikey'))
                ->email(config('services.cleansms.email'))
                ->sendSms(
                    $content,
                    $recipient,
                    isset($transactional) ? $transactional : true
                );

            if ($result != true) throw new Exception(__('Could not send the message.'));
        }
        catch (Exception $e) {
            throw CouldNotSendNotification::serviceRespondedWithAnError($e->getMessage());
        }
    }
}