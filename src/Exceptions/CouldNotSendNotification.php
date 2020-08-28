<?php

/*
 * CouldNotSendNotification.php
 *
 *  @author    Ulrich Pascal Ndjike Zoa <ndjikezoaulrich@gmail.com>
 *  @project    cleansms-notification-channel
 *
 *  Copyright 2020
 *  28/08/2020 00:30
 */

namespace Undjike\CleanSmsNotificationChannel\Exceptions;

use Exception;

class CouldNotSendNotification extends Exception
{
    /**
     * @param $error
     * @return static
     */
    public static function serviceRespondedWithAnError($error)
    {
        return new static(__('CleanSMS service responded with an error:') . ' ' . $error);
    }
}